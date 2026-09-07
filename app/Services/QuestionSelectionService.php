<?php

namespace App\Services;

use App\Models\Category;
use App\Models\GameSessionQuestion;

class QuestionSelectionService
{
    private $CategoriesService;
    public function __construct()
    {
        $this->CategoriesService = new CategoriesService();
    }

    public function selectQuestion(array $categoriesIds , int $numberOfQuestions){
        $result = [];
        // to get selected categories
        $categories = $this->CategoriesService->getSelectedCategories($categoriesIds);

        // to get the question and hints randomly from the selected categories
        foreach ($categories as $category) {
            $questionForCategories = $category->questions()
                ->select(['id', 'category_id', 'answer'])
                ->inRandomOrder()
                ->limit($numberOfQuestions)
                ->with(['hints' => function ($query) {
                    $query->select(['id', 'question_id', 'level_id', 'hint_text']);
                }])
                ->get();

            $result[] = [
                'category' => $category,
                'questions' => $questionForCategories
            ];
        }
        return $result;
    }

    public function getQuestionByPackages(int $gameSessionId , int $packageNumber){
        $StartingQuestion = ($packageNumber - 1) * 10 ;
       return GameSessionQuestion::query()
           ->where('game_session_id', $gameSessionId)
           ->with('question.hints')
           ->orderBy('order')
           ->skip($StartingQuestion)
           ->take(10)
           ->get();
    }


}
