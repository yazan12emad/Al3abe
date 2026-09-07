<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    public function hints(){
        return $this->hasMany(Hints::class);
    }

}
