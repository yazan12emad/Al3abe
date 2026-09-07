<?php

namespace App\Actions;

use App\Http\Requests\StartGameSessionRequest;
use App\Http\Resources\GameSessionQuestionResource;
use App\Models\GameSession;
use App\Models\GameSessionQuestion;
use App\Services\QuestionSelectionService;

class StartGameSessionActions
{
    public $totalQuestions;
    public $questionPerPackage = 10;
    private $QuestionSelectionService;
    public function __construct(){
        $this->QuestionSelectionService = new QuestionSelectionService();
    }

    /**
     * @throws \Exception
     */
    public function startGameSession(array $gameData):GameSession{

            $gameSession = $this->createSession($gameData);
             if(!$gameSession)
                 throw new \Exception("Game Session not created");

               $question =  $this->QuestionSelectionService
                   ->selectQuestion($gameData['categories_id'] , $gameData['number_of_questions']);
             $this->saveQuestionOrder($question ,$gameSession['id']);
                if(!$question)
                    throw new \Exception("Question not inserted correctly");

                return $gameSession;

    }

    /**
     * @throws \Exception
     */
    public function createSession(array $gameData)
    {
        $this->totalQuestions = count($gameData['categories_id']) * $gameData['number_of_questions'];
        $result = GameSession::create([
            'game_id' => $gameData['game_id'],
            'total_questions' => $this->totalQuestions,
            'questions_per_package' => $this->questionPerPackage,
        ]);
         if(!$result)
             throw new \Exception("Game Session not created , added to database");

             return $result;
    }

    public function saveQuestionOrder(array $questions , $gameSessionId): void
    {
        $order = 1;

        for($questionIndex = 0 ; $questionIndex < $this->totalQuestions ; $questionIndex++){
            foreach($questions as $categoryGroup){
                $question = $categoryGroup['questions']->get($questionIndex);
                if($question === null){
                    continue;
                }
               GameSessionQuestion::create([
                    'game_session_id' => $gameSessionId,
                    'question_id' => $question->id,
                    'order' => $order,
                ]);
                $order++;
            }
        }

    }

        public function getGameQuestions(int $gameSessionId , int $packageNumber){
           return GameSessionQuestionResource::collection($this->QuestionSelectionService
               ->getQuestionByPackages($gameSessionId ,$packageNumber));
        }









}
