<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hints extends Model
{
    public function Hints(){
       return $this->belongsTo(Question::class);
    }
}
