<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    // return all the games we have
    public function games(){
        $games = Games::select(['id' , 'game_name' , 'image_path' , 'description'])
            ->get();
        return $this->jsonResponse($games , 200);
    }
}
