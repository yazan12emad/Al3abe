<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{

    public function run(): void
    {
        $jsonDateFile = file_get_contents(database_path('Json_files/Questions Data/Data-of-questions-from(12-22).json'));
        $questions = json_decode($jsonDateFile, true);

        foreach ($questions as $questionData) {
            $questionId = DB::table('questions')->insertGetId([
                'category_id' => $questionData['category_id'],
                'answer' => $questionData['answer'],
                'created_at' => $questionData['created_at'] ?? now(),
                'updated_at' => $questionData['updated_at'] ?? now(),]);

            foreach ($questionData['hints'] as $hint) {
                DB::table('hints')->insert([
                    'question_id' => $questionId,
                    'level_id' => $hint['level_id'],
                    'hint_text' => $hint['hint_text'],
                    'created_at' => $hint['created_at'] ?? now(),
                    'updated_at' => $hint['updated_at'] ?? now(),]);
            }
        }


    }
}
