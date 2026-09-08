const root = document.querySelector('[data-al3abe-test]');

if (root) {
    const apiBaseUrl = root.dataset.apiBaseUrl;

    const state = {
        games: [],
        categories: [],
        selectedCategoryIds: new Set(),
        session: null,
        questions: [],
        currentQuestionIndex: 0,
        revealedHintLevels: new Set(),
        lastRequest: null,
        lastResponse: null,
        lastStatus: null,
        lastError: null,
    };

    const elements = {
        setup: root.querySelector('[data-screen="setup"]'),
        play: root.querySelector('[data-screen="play"]'),
        complete: root.querySelector('[data-screen="complete"]'),
        gameSelect: root.querySelector('[data-game-select]'),
        categoryGrid: root.querySelector('[data-category-grid]'),
        categoryCount: root.querySelector('[data-category-count]'),
        numberOfQuestions: root.querySelector('[data-number-of-questions]'),
        startButton: root.querySelector('[data-start-game]'),
        loading: root.querySelector('[data-loading]'),
        error: root.querySelector('[data-error]'),
        errorMessage: root.querySelector('[data-error-message]'),
        progress: root.querySelector('[data-progress]'),
        progressBar: root.querySelector('[data-progress-bar]'),
        categoryName: root.querySelector('[data-current-category]'),
        questionNumber: root.querySelector('[data-question-number]'),
        questionId: root.querySelector('[data-current-question-id]'),
        hints: root.querySelector('[data-hints]'),
        answerText: root.querySelector('[data-answer-text]'),
        nextButton: root.querySelector('[data-next-question]'),
        sessionId: root.querySelector('[data-session-id]'),
        devSessionId: root.querySelector('[data-dev-session-id]'),
        devQuestionId: root.querySelector('[data-dev-question-id]'),
        devCategory: root.querySelector('[data-dev-category]'),
        devProgress: root.querySelector('[data-dev-progress]'),
        devRequest: root.querySelector('[data-dev-request]'),
        devResponse: root.querySelector('[data-dev-response]'),
        devStatus: root.querySelector('[data-dev-status]'),
        devError: root.querySelector('[data-dev-error]'),
        restartButtons: root.querySelectorAll('[data-restart]'),
    };

    class ApiError extends Error {
        constructor(message, status, payload) {
            super(message);
            this.status = status;
            this.payload = payload;
        }
    }

    const api = {
        async request(path, options = {}) {
            const method = options.method ?? 'GET';
            const request = {
                method,
                url: `${apiBaseUrl}${path}`,
                body: options.body ?? null,
            };

            state.lastRequest = request;
            updateDeveloperPanel();

            const response = await fetch(request.url, {
                method,
                credentials: 'same-origin',
                headers: {
                    Accept: 'application/json',
                    ...(options.body ? { 'Content-Type': 'application/json' } : {}),
                },
                body: options.body ? JSON.stringify(options.body) : undefined,
            });

            const text = await response.text();
            let payload = null;

            try {
                payload = text === '' ? null : JSON.parse(text);
            } catch {
                payload = text;
            }

            state.lastStatus = response.status;
            state.lastResponse = payload;
            updateDeveloperPanel();

            if (!response.ok) {
                throw new ApiError(readApiError(payload), response.status, payload);
            }

            return normalizePayload(payload);
        },

        games() {
            return this.request('/games');
        },

        categories() {
            return this.request('/categories');
        },

        startSession(payload) {
            return this.request('/start-game-request', {
                method: 'POST',
                body: payload,
            });
        },

        sessionQuestions(sessionId, packageNumber) {
            return this.request(`/game-session/${sessionId}/questions?package=${packageNumber}`);
        },
    };

    function normalizePayload(payload) {
        if (typeof payload !== 'string') {
            return payload;
        }

        try {
            return JSON.parse(payload);
        } catch {
            return payload;
        }
    }

    function readApiError(payload) {
        if (payload && typeof payload === 'object') {
            if (payload.errors) {
                return Object.values(payload.errors).flat().join(' ');
            }

            if (payload.message) {
                return payload.message;
            }
        }

        return typeof payload === 'string' && payload !== ''
            ? payload
            : 'تعذر إكمال طلب الـ API.';
    }

    function setLoading(isLoading, message = 'جارِ الاتصال بالـ API…') {
        elements.loading.textContent = message;
        elements.loading.classList.toggle('hidden', !isLoading);
        elements.startButton.disabled = isLoading;
        elements.nextButton.disabled = isLoading;
    }

    function showError(message) {
        state.lastError = message;
        elements.errorMessage.textContent = message;
        elements.error.classList.remove('hidden');
        updateDeveloperPanel();
    }

    function clearError() {
        state.lastError = null;
        elements.error.classList.add('hidden');
        updateDeveloperPanel();
    }

    function renderGames() {
        elements.gameSelect.innerHTML = '<option value="">اختر اللعبة</option>';

        state.games.forEach((game) => {
            const option = document.createElement('option');
            option.value = game.id;
            option.textContent = game.game_name;
            elements.gameSelect.append(option);
        });
    }

    function renderCategories() {
        elements.categoryGrid.innerHTML = '';

        state.categories.forEach((category) => {
            const isSelected = state.selectedCategoryIds.has(category.id);
            const card = document.createElement('button');
            card.type = 'button';
            card.dataset.categoryId = category.id;
            card.className = `al3abe-category-card${isSelected ? ' is-selected' : ''}`;
            card.innerHTML = `
                <div class="al3abe-category-card-top">
                    <span class="al3abe-category-icon">🎯</span>
                    <span class="al3abe-category-badge${isSelected ? ' is-selected' : ''}">${isSelected ? 'مختارة' : 'اختيار'}</span>
                </div>
                <h3 class="al3abe-category-name">${escapeHtml(category.name)}</h3>
                <p class="al3abe-category-desc">${escapeHtml(category.description ?? 'لا يوجد وصف لهذه الفئة.')}</p>
            `;
            elements.categoryGrid.append(card);
        });

        elements.categoryCount.textContent = `${state.selectedCategoryIds.size} / 5 فئات مختارة`;
    }

    function currentQuestion() {
        return state.questions[state.currentQuestionIndex] ?? null;
    }

    function categoryForQuestion(question) {
        return state.categories.find((category) => category.id === question?.question?.category_id) ?? null;
    }

    function renderQuestion() {
        const sessionQuestion = currentQuestion();

        if (!sessionQuestion) {
            finishGame();
            return;
        }

        const category = categoryForQuestion(sessionQuestion);
        const total = state.session?.total_questions ?? state.questions.length;
        const position = state.currentQuestionIndex + 1;
        const percentage = total > 0 ? Math.min((position / total) * 100, 100) : 0;

        elements.sessionId.textContent = `جلسة #${state.session.id}`;
        elements.categoryName.textContent = category?.name ?? `فئة #${sessionQuestion.question.category_id}`;
        elements.questionNumber.textContent = `السؤال ${position} من ${total}`;
        elements.questionId.textContent = `معرّف السؤال: ${sessionQuestion.question_id}`;
        elements.progress.textContent = `${position} / ${total}`;
        elements.progressBar.style.width = `${percentage}%`;
        elements.answerText.textContent = sessionQuestion.question.answer;
        state.revealedHintLevels = new Set();
        renderHints(sessionQuestion.question.hints ?? []);
        updateDeveloperPanel();
    }

    function renderHints(hints) {
        const hintStyles = {
            1: {
                title: '🔴 تلميح صعب',
                subtitle: 'إشارة خفيفة بأقل قدر من المعلومات',
                cardClass: 'al3abe-hint-hard',
                buttonClass: 'al3abe-hint-reveal-hard',
            },
            2: {
                title: '🟡 تلميح متوسط',
                subtitle: 'معلومة أوضح لتضييق الإجابة',
                cardClass: 'al3abe-hint-medium',
                buttonClass: 'al3abe-hint-reveal-medium',
            },
            3: {
                title: '🟢 تلميح سهل',
                subtitle: 'أوضح تلميح متاح',
                cardClass: 'al3abe-hint-easy',
                buttonClass: 'al3abe-hint-reveal-easy',
            },
        };

        elements.hints.innerHTML = '';

        [...hints]
            .sort((firstHint, secondHint) => firstHint.level_id - secondHint.level_id)
            .forEach((hint) => {
                const style = hintStyles[hint.level_id] ?? hintStyles[3];
                const card = document.createElement('article');
                card.className = `al3abe-hint ${style.cardClass}`;
                card.innerHTML = `
                    <div class="al3abe-hint-header">
                        <div>
                            <h3 class="al3abe-hint-title">${style.title}</h3>
                            <p class="al3abe-hint-subtitle">${style.subtitle}</p>
                        </div>
                        <button type="button" data-reveal-hint="${hint.level_id}" class="al3abe-hint-reveal ${style.buttonClass}">إظهار</button>
                    </div>
                    <p data-hint-text="${hint.level_id}" class="al3abe-hint-text hidden"></p>
                `;
                card.querySelector(`[data-hint-text="${hint.level_id}"]`).textContent = hint.hint_text;
                elements.hints.append(card);
            });

        if (hints.length === 0) {
            elements.hints.innerHTML = '<p class="al3abe-hint-empty">لم يُرجع الـ API أي تلميحات لهذا السؤال.</p>';
        }
    }

    function revealHint(level) {
        const sessionQuestion = currentQuestion();
        const hint = sessionQuestion?.question?.hints?.find((item) => item.level_id === level);

        if (!hint) {
            return;
        }

        state.revealedHintLevels.add(level);
        const text = elements.hints.querySelector(`[data-hint-text="${level}"]`);
        const button = elements.hints.querySelector(`[data-reveal-hint="${level}"]`);

        text.classList.remove('hidden');
        button.textContent = 'تم الإظهار';
        button.disabled = true;
        button.classList.add('is-revealed');
    }

    async function loadQuestionPackage(packageNumber) {
        const result = await api.sessionQuestions(state.session.id, packageNumber);
        const questions = Array.isArray(result) ? result : (result?.data ?? []);

        if (questions.length > 0) {
            state.questions.push(...questions);
        }

        return questions.length;
    }

    async function startGame() {
        clearError();

        if (!elements.gameSelect.value) {
            showError('اختر لعبة قبل بدء الجلسة.');
            return;
        }

        if (state.selectedCategoryIds.size < 1 || state.selectedCategoryIds.size > 5) {
            showError('اختر من فئة واحدة إلى خمس فئات.');
            return;
        }

        setLoading(true, 'جارِ إنشاء جلسة اللعبة…');

        try {
            state.session = await api.startSession({
                game_id: Number(elements.gameSelect.value),
                categories_id: [...state.selectedCategoryIds],
                number_of_questions: Number(elements.numberOfQuestions.value),
            });
            state.questions = [];
            state.currentQuestionIndex = 0;

            setLoading(true, 'جارِ تحميل أسئلة الجلسة…');
            const questionCount = await loadQuestionPackage(1);

            if (questionCount === 0) {
                throw new ApiError('تم إنشاء الجلسة، لكن الـ API لم يُرجع أسئلة لهذه الفئات.', state.lastStatus, state.lastResponse);
            }

            showScreen('play');
            renderQuestion();
        } catch (error) {
            showError(error.message ?? 'تعذر بدء اللعبة.');
        } finally {
            setLoading(false);
        }
    }

    async function nextQuestion() {
        clearError();
        const nextIndex = state.currentQuestionIndex + 1;

        if (nextIndex >= state.questions.length) {
            const total = state.session?.total_questions ?? state.questions.length;

            if (state.questions.length >= total) {
                finishGame();
                return;
            }

            setLoading(true, 'جارِ تحميل الحزمة التالية من الأسئلة…');

            try {
                const packageNumber = Math.floor(state.questions.length / 10) + 1;
                const questionCount = await loadQuestionPackage(packageNumber);

                if (questionCount === 0) {
                    finishGame();
                    return;
                }
            } catch (error) {
                showError(error.message ?? 'تعذر تحميل الأسئلة التالية.');
                return;
            } finally {
                setLoading(false);
            }
        }

        state.currentQuestionIndex = nextIndex;
        renderQuestion();
    }

    function finishGame() {
        showScreen('complete');
        updateDeveloperPanel();
    }

    function showScreen(screen) {
        elements.setup.classList.toggle('hidden', screen !== 'setup');
        elements.play.classList.toggle('hidden', screen !== 'play');
        elements.complete.classList.toggle('hidden', screen !== 'complete');
    }

    function restart() {
        state.session = null;
        state.questions = [];
        state.currentQuestionIndex = 0;
        state.revealedHintLevels = new Set();
        clearError();
        showScreen('setup');
        updateDeveloperPanel();
    }

    function updateDeveloperPanel() {
        const question = currentQuestion();
        const category = categoryForQuestion(question);
        const total = state.session?.total_questions ?? 0;

        elements.devSessionId.textContent = state.session?.id ?? '—';
        elements.devQuestionId.textContent = question?.question_id ?? '—';
        elements.devCategory.textContent = category?.name ?? '—';
        elements.devProgress.textContent = question ? `${state.currentQuestionIndex + 1} / ${total}` : '—';
        elements.devRequest.textContent = state.lastRequest ? JSON.stringify(state.lastRequest, null, 2) : '—';
        elements.devResponse.textContent = state.lastResponse !== null ? JSON.stringify(state.lastResponse, null, 2) : '—';
        elements.devStatus.textContent = state.lastStatus ?? '—';
        elements.devError.textContent = state.lastError ?? '—';
    }

    function escapeHtml(value) {
        const element = document.createElement('span');
        element.textContent = String(value);
        return element.innerHTML;
    }

    elements.categoryGrid.addEventListener('click', (event) => {
        const card = event.target.closest('[data-category-id]');

        if (!card) {
            return;
        }

        const categoryId = Number(card.dataset.categoryId);

        if (state.selectedCategoryIds.has(categoryId)) {
            state.selectedCategoryIds.delete(categoryId);
        } else if (state.selectedCategoryIds.size < 5) {
            state.selectedCategoryIds.add(categoryId);
        } else {
            showError('الـ API يسمح باختيار خمس فئات كحد أقصى.');
            return;
        }

        clearError();
        renderCategories();
    });

    elements.startButton.addEventListener('click', startGame);
    elements.nextButton.addEventListener('click', nextQuestion);
    elements.hints.addEventListener('click', (event) => {
        const button = event.target.closest('[data-reveal-hint]');

        if (button) {
            revealHint(Number(button.dataset.revealHint));
        }
    });
    elements.restartButtons.forEach((button) => button.addEventListener('click', restart));

    async function initialize() {
        setLoading(true, 'جارِ تحميل الألعاب والفئات…');
        clearError();

        try {
            const [games, categories] = await Promise.all([api.games(), api.categories()]);
            state.games = Array.isArray(games) ? games : (games?.data ?? []);
            state.categories = Array.isArray(categories) ? categories : (categories?.data ?? []);
            renderGames();
            renderCategories();

            if (state.games.length === 0 || state.categories.length === 0) {
                showError('لم يُرجع الـ API ألعاباً أو فئات قابلة للاختبار.');
            }
        } catch (error) {
            showError(error.message ?? 'تعذر تحميل بيانات البداية من الـ API.');
        } finally {
            setLoading(false);
            updateDeveloperPanel();
        }
    }

    initialize();
}
