{{--<!DOCTYPE html>--}}
{{--<html lang="ar" dir="rtl">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    <title>مختبر ألعاب | Al3abe</title>--}}
{{--    @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
{{--</head>--}}
{{--<body class="min-h-screen bg-slate-950 font-sans text-slate-100 antialiased">--}}
{{--<main--}}
{{--    data-al3abe-test--}}
{{--    data-api-base-url="{{ url('/api') }}"--}}
{{--    class="mx-auto min-h-screen max-w-6xl px-4 py-6 sm:px-6 lg:px-8"--}}
{{-->--}}
{{--    <header class="mb-8 rounded-3xl border border-white/10 bg-gradient-to-l from-sky-500/20 via-slate-900 to-violet-500/20 p-6 shadow-2xl shadow-sky-950/20 sm:p-8">--}}
{{--        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">--}}
{{--            <div>--}}
{{--                <p class="mb-2 text-sm font-bold tracking-widest text-sky-300">AL3ABE API LAB</p>--}}
{{--                <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">مختبر لعبة التلميحات</h1>--}}
{{--                <p class="mt-3 max-w-2xl leading-7 text-slate-300">واجهة اختبار تعمل مباشرة مع نقاط نهاية الـ API الحالية، بدون تغيير منطق اللعبة في الخلفية.</p>--}}
{{--            </div>--}}
{{--            <button data-restart type="button" class="rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-sm font-bold text-white transition hover:bg-white/20">لعبة جديدة</button>--}}
{{--        </div>--}}
{{--    </header>--}}

{{--    <div data-loading class="mb-5 hidden rounded-2xl border border-sky-400/30 bg-sky-500/10 px-4 py-3 text-sm font-semibold text-sky-100" role="status"></div>--}}

{{--    <div data-error class="mb-5 hidden rounded-2xl border border-rose-400/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-100" role="alert">--}}
{{--        <span class="font-black">تعذر إكمال العملية:</span>--}}
{{--        <span data-error-message></span>--}}
{{--    </div>--}}

{{--    <section data-screen="setup" class="rounded-3xl border border-white/10 bg-slate-900/80 p-5 shadow-xl shadow-black/20 sm:p-7">--}}
{{--        <div class="mb-6 flex flex-col gap-4 border-b border-white/10 pb-6 sm:flex-row sm:items-end sm:justify-between">--}}
{{--            <div>--}}
{{--                <p class="text-sm font-bold text-sky-300">الخطوة 1</p>--}}
{{--                <h2 class="mt-1 text-2xl font-black text-white">إعداد جلسة الاختبار</h2>--}}
{{--                <p class="mt-2 text-sm text-slate-400">اختر لعبة، ومن 1 إلى 5 فئات، ثم عدد الأسئلة لكل فئة.</p>--}}
{{--            </div>--}}
{{--            <p data-category-count class="rounded-full bg-white/10 px-4 py-2 text-sm font-bold text-slate-200">0 / 5 فئات مختارة</p>--}}
{{--        </div>--}}

{{--        <div class="mb-7 grid gap-4 sm:grid-cols-2">--}}
{{--            <label class="grid gap-2 text-sm font-bold text-slate-200">--}}
{{--                اللعبة--}}
{{--                <select data-game-select class="w-full rounded-xl border border-white/10 bg-slate-800 px-4 py-3 text-white outline-none transition focus:border-sky-400 focus:ring-2 focus:ring-sky-400/30"></select>--}}
{{--            </label>--}}
{{--            <label class="grid gap-2 text-sm font-bold text-slate-200">--}}
{{--                عدد الأسئلة لكل فئة--}}
{{--                <select data-number-of-questions class="w-full rounded-xl border border-white/10 bg-slate-800 px-4 py-3 text-white outline-none transition focus:border-sky-400 focus:ring-2 focus:ring-sky-400/30">--}}
{{--                    @for ($number = 1; $number <= 10; $number++)--}}
{{--                        <option value="{{ $number }}" @selected($number === 2)>{{ $number }} سؤال{{ $number === 1 ? '' : 'ات' }}</option>--}}
{{--                    @endfor--}}
{{--                </select>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <h3 class="mb-3 text-lg font-black text-white">اختر الفئات</h3>--}}
{{--            <div data-category-grid class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3"></div>--}}
{{--        </div>--}}

{{--        <div class="mt-7 flex justify-end border-t border-white/10 pt-5">--}}
{{--            <button data-start-game type="button" class="rounded-xl bg-sky-400 px-6 py-3 font-black text-slate-950 transition hover:bg-sky-300 disabled:cursor-not-allowed disabled:opacity-60">ابدأ جلسة الاختبار ←</button>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section data-screen="play" class="hidden">--}}
{{--        <div class="mb-5 rounded-3xl border border-white/10 bg-slate-900/80 p-5 sm:p-7">--}}
{{--            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">--}}
{{--                <div>--}}
{{--                    <p data-session-id class="text-sm font-bold text-sky-300"></p>--}}
{{--                    <h2 data-current-category class="mt-1 text-2xl font-black text-white"></h2>--}}
{{--                    <p data-current-question-id class="mt-1 text-xs text-slate-500"></p>--}}
{{--                </div>--}}
{{--                <p data-question-number class="rounded-xl bg-violet-500/15 px-4 py-3 text-sm font-black text-violet-200"></p>--}}
{{--            </div>--}}
{{--            <div class="h-2 overflow-hidden rounded-full bg-slate-800">--}}
{{--                <div data-progress-bar class="h-full rounded-full bg-gradient-to-l from-sky-400 to-violet-400 transition-all duration-500"></div>--}}
{{--            </div>--}}
{{--            <p class="mt-2 text-left text-xs font-bold text-slate-400"><span data-progress></span></p>--}}
{{--        </div>--}}

{{--        <div class="grid gap-5 lg:grid-cols-[1.35fr_0.65fr]">--}}
{{--            <section class="rounded-3xl border border-white/10 bg-slate-900/80 p-5 shadow-xl shadow-black/20 sm:p-7">--}}
{{--                <p class="text-sm font-bold text-sky-300">التحدي الحالي</p>--}}
{{--                <h2 class="mt-2 text-3xl font-black leading-tight text-white">ما هي الإجابة؟</h2>--}}
{{--                <p class="mt-3 leading-7 text-slate-300">اكشف التلميحات بالتدريج، ثم يقرأ الحكم الإجابة للاعبين شفهياً.</p>--}}

{{--                <div data-hints class="mt-6 grid gap-3"></div>--}}

{{--                <section class="mt-6 rounded-2xl border border-emerald-400/35 bg-emerald-500/10 p-5">--}}
{{--                    <p class="text-sm font-black text-emerald-300">إجابة الحكم</p>--}}
{{--                    <p data-answer-text class="mt-2 text-xl font-black leading-8 text-white"></p>--}}
{{--                    <p class="mt-2 text-sm text-emerald-100">تظهر دائماً للحكم ليعلنها أو يتحقق من إجابة اللاعبين شفهياً.</p>--}}
{{--                </section>--}}
{{--            </section>--}}

{{--            <aside class="flex flex-col rounded-3xl border border-white/10 bg-slate-900/80 p-5 shadow-xl shadow-black/20 sm:p-7">--}}
{{--                <h2 class="text-xl font-black text-white">التحكم بالجولة</h2>--}}
{{--                <p class="mt-3 text-sm leading-6 text-slate-400">بعد اختبار الإجابة أو التلميحات، انتقل إلى السؤال التالي بالترتيب الذي حفظه الـ API.</p>--}}
{{--                <button data-next-question type="button" class="mt-6 rounded-xl bg-violet-500 px-5 py-3 font-black text-white transition hover:bg-violet-400 disabled:cursor-not-allowed disabled:opacity-60">السؤال التالي</button>--}}
{{--                <button data-restart type="button" class="mt-3 rounded-xl border border-white/15 px-5 py-3 font-bold text-slate-200 transition hover:bg-white/10">إعادة البدء</button>--}}
{{--            </aside>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section data-screen="complete" class="hidden rounded-3xl border border-emerald-400/30 bg-emerald-500/10 p-8 text-center shadow-xl shadow-emerald-950/20">--}}
{{--        <p class="text-5xl">🏁</p>--}}
{{--        <h2 class="mt-4 text-3xl font-black text-white">انتهت جلسة الاختبار</h2>--}}
{{--        <p class="mt-3 text-slate-200">تم عرض جميع الأسئلة التي أعادها الـ API لهذه الجلسة.</p>--}}
{{--        <button data-restart type="button" class="mt-6 rounded-xl bg-emerald-500 px-6 py-3 font-black text-white transition hover:bg-emerald-400">ابدأ جلسة جديدة</button>--}}
{{--    </section>--}}

{{--    <details class="mt-6 rounded-2xl border border-white/10 bg-slate-900/70">--}}
{{--        <summary class="cursor-pointer px-5 py-4 font-black text-slate-200">أدوات المطوّر والاختبار</summary>--}}
{{--        <div class="grid gap-4 border-t border-white/10 p-5 text-sm lg:grid-cols-2">--}}
{{--            <dl class="grid grid-cols-2 gap-3 rounded-xl bg-slate-800/70 p-4">--}}
{{--                <dt class="text-slate-400">معرّف الجلسة</dt><dd data-dev-session-id class="font-bold text-white">—</dd>--}}
{{--                <dt class="text-slate-400">معرّف السؤال</dt><dd data-dev-question-id class="font-bold text-white">—</dd>--}}
{{--                <dt class="text-slate-400">الفئة الحالية</dt><dd data-dev-category class="font-bold text-white">—</dd>--}}
{{--                <dt class="text-slate-400">التقدم</dt><dd data-dev-progress class="font-bold text-white">—</dd>--}}
{{--                <dt class="text-slate-400">HTTP status</dt><dd data-dev-status class="font-bold text-white">—</dd>--}}
{{--                <dt class="text-slate-400">آخر خطأ</dt><dd data-dev-error class="break-words font-bold text-rose-200">—</dd>--}}
{{--            </dl>--}}
{{--            <div class="grid gap-4">--}}
{{--                <div><p class="mb-2 font-bold text-slate-300">آخر طلب</p><pre data-dev-request class="max-h-48 overflow-auto rounded-xl bg-slate-950 p-4 text-xs leading-6 text-sky-200">—</pre></div>--}}
{{--                <div><p class="mb-2 font-bold text-slate-300">آخر استجابة</p><pre data-dev-response class="max-h-48 overflow-auto rounded-xl bg-slate-950 p-4 text-xs leading-6 text-emerald-200">—</pre></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </details>--}}
{{--</main>--}}
{{--</body>--}}
{{--</html>--}}


    <!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>مختبر ألعاب | Al3abe</title>
    <link rel="stylesheet" href="{{ asset('test/css/test.css') }}">
</head>
<body class="al3abe-body">
<main
    data-al3abe-test
    data-api-base-url="{{ url('/api') }}"
    class="al3abe-container"
>
    <header class="al3abe-header">
        <div class="al3abe-header-inner">
            <div>
                <p class="al3abe-eyebrow">AL3ABE API LAB</p>
                <h1 class="al3abe-title">مختبر لعبة التلميحات</h1>
                <p class="al3abe-subtitle">واجهة اختبار تعمل مباشرة مع نقاط نهاية الـ API الحالية، بدون تغيير منطق اللعبة في الخلفية.</p>
            </div>
            <button data-restart type="button" class="btn btn-ghost">لعبة جديدة</button>
        </div>
    </header>

    <div data-loading class="al3abe-banner al3abe-banner-loading hidden" role="status"></div>

    <div data-error class="al3abe-banner al3abe-banner-error hidden" role="alert">
        <span class="al3abe-banner-label">تعذر إكمال العملية:</span>
        <span data-error-message></span>
    </div>

    <section data-screen="setup" class="al3abe-card">
        <div class="al3abe-card-header">
            <div>
                <p class="al3abe-step-label">الخطوة 1</p>
                <h2 class="al3abe-card-title">إعداد جلسة الاختبار</h2>
                <p class="al3abe-card-desc">اختر لعبة، ومن 1 إلى 5 فئات، ثم عدد الأسئلة لكل فئة.</p>
            </div>
            <p data-category-count class="al3abe-pill">0 / 5 فئات مختارة</p>
        </div>

        <div class="al3abe-form-grid">
            <label class="al3abe-field">
                اللعبة
                <select data-game-select class="al3abe-select"></select>
            </label>
            <label class="al3abe-field">
                عدد الأسئلة لكل فئة
                <select data-number-of-questions class="al3abe-select">
                    @for ($number = 1; $number <= 10; $number++)
                        <option value="{{ $number }}" @selected($number === 2)>{{ $number }} سؤال{{ $number === 1 ? '' : 'ات' }}</option>
                    @endfor
                </select>
            </label>
        </div>

        <div>
            <h3 class="al3abe-section-title">اختر الفئات</h3>
            <div data-category-grid class="al3abe-category-grid"></div>
        </div>

        <div class="al3abe-card-footer">
            <button data-start-game type="button" class="btn btn-primary">ابدأ جلسة الاختبار ←</button>
        </div>
    </section>

    <section data-screen="play" class="hidden">
        <div class="al3abe-card al3abe-play-status">
            <div class="al3abe-play-status-row">
                <div>
                    <p data-session-id class="al3abe-session-id"></p>
                    <h2 data-current-category class="al3abe-current-category"></h2>
                    <p data-current-question-id class="al3abe-current-question-id"></p>
                </div>
                <p data-question-number class="al3abe-question-number"></p>
            </div>
            <div class="al3abe-progress-track">
                <div data-progress-bar class="al3abe-progress-bar"></div>
            </div>
            <p class="al3abe-progress-label"><span data-progress></span></p>
        </div>

        <div class="al3abe-play-grid">
            <section class="al3abe-card">
                <p class="al3abe-step-label">التحدي الحالي</p>
                <h2 class="al3abe-question-heading">ما هي الإجابة؟</h2>
                <p class="al3abe-card-desc">اكشف التلميحات بالتدريج، ثم يقرأ الحكم الإجابة للاعبين شفهياً.</p>

                <div data-hints class="al3abe-hints"></div>

                <section class="al3abe-answer-box">
                    <p class="al3abe-answer-label">إجابة الحكم</p>
                    <p data-answer-text class="al3abe-answer-text"></p>
                    <p class="al3abe-answer-note">تظهر دائماً للحكم ليعلنها أو يتحقق من إجابة اللاعبين شفهياً.</p>
                </section>
            </section>

            <aside class="al3abe-card al3abe-controls">
                <h2 class="al3abe-card-title">التحكم بالجولة</h2>
                <p class="al3abe-card-desc">بعد اختبار الإجابة أو التلميحات، انتقل إلى السؤال التالي بالترتيب الذي حفظه الـ API.</p>
                <button data-next-question type="button" class="btn btn-secondary">السؤال التالي</button>
                <button data-restart type="button" class="btn btn-ghost">إعادة البدء</button>
            </aside>
        </div>
    </section>

    <section data-screen="complete" class="al3abe-complete hidden">
        <p class="al3abe-complete-emoji">🏁</p>
        <h2 class="al3abe-complete-title">انتهت جلسة الاختبار</h2>
        <p class="al3abe-complete-desc">تم عرض جميع الأسئلة التي أعادها الـ API لهذه الجلسة.</p>
        <button data-restart type="button" class="btn btn-success">ابدأ جلسة جديدة</button>
    </section>

    <details class="al3abe-dev">
        <summary class="al3abe-dev-summary">أدوات المطوّر والاختبار</summary>
        <div class="al3abe-dev-body">
            <dl class="al3abe-dev-list">
                <dt>معرّف الجلسة</dt><dd data-dev-session-id>—</dd>
                <dt>معرّف السؤال</dt><dd data-dev-question-id>—</dd>
                <dt>الفئة الحالية</dt><dd data-dev-category>—</dd>
                <dt>التقدم</dt><dd data-dev-progress>—</dd>
                <dt>HTTP status</dt><dd data-dev-status>—</dd>
                <dt>آخر خطأ</dt><dd data-dev-error class="is-error">—</dd>
            </dl>
            <div class="al3abe-dev-logs">
                <div>
                    <p class="al3abe-dev-log-label">آخر طلب</p>
                    <pre data-dev-request class="al3abe-dev-pre al3abe-dev-pre-request">—</pre>
                </div>
                <div>
                    <p class="al3abe-dev-log-label">آخر استجابة</p>
                    <pre data-dev-response class="al3abe-dev-pre al3abe-dev-pre-response">—</pre>
                </div>
            </div>
        </div>
    </details>
</main>
<script src="{{ asset('test/js/test.js') }}" defer></script>
</body>
</html>
