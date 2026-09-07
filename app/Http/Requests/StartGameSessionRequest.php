<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StartGameSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'game_id' => ['required' , 'integer', 'exists:games,id'],
            'categories_id' => ['required', 'array', 'min:1', 'max:5'],
            'categories_id.*' => ['integer', 'exists:categories,id'],
            'number_of_questions' => ['required' , 'integer' , 'min:1' , 'max:10'] ,
        ];
    }

    public function messages(): array{
        return [
            'game_id.exists' => 'The selected game does not exist.',
            'id.min' => 'Min select 1 category' ,
            'id.max' => 'Max 5 category' ,
            'numberOfQuestions.min' => 'Min 1 question for each category' ,
            'numberOfQuestions.max' => 'Max 10 question for each category' ,
        ] ;
    }
}
