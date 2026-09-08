<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartGameSessionRequest;
use App\Actions\StartGameSessionActions;
use Illuminate\Http\Request;

class GameSessionController extends Controller
{
    private $StartGameSession;

    public function __construct(){
        $this->StartGameSession = new StartGameSessionActions();
    }
    public function sessionStart(StartGameSessionRequest $request){
        try {
           return $this->jsonResponse($this->StartGameSession->startGameSession($request->validated()) , 200);
        }
        catch(\Exception $e){
            return $this->jsonResponse($e->getMessage());
        }
    }

    public function getQuestions(Request $request, $id){
        return $this->jsonResponse($this->StartGameSession->getGameQuestions($id ,$request->query('package')));
    }



}
