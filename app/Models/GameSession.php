<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameSession extends Model
{
    protected $fillable = [
        'game_id',
        'total_questions',
        'questions_per_package',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Games::class);
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
