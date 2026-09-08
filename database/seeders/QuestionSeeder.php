<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * @throws \Throwable
     * @throws \JsonException
     */
    public function run(): void
    {
        $files = [
            'Data-of-questions-from(1-11).json',
            'Data-of-questions-from(12-22).json',
        ];

        $questions = [];

        foreach ($files as $file) {
            $json = file_get_contents(
                database_path("Json_files/Questions_Data/{$file}")
            );

            $questions = array_merge(
                $questions,
                json_decode($json, true, 512, JSON_THROW_ON_ERROR)
            );
        }

        DB::transaction(function () use ($questions) {

            foreach ($questions as $questionData) {

                $questionId = DB::table('questions')->insertGetId([
                    'category_id' => $questionData['category_id'],
                    'answer' => $questionData['answer'],
                    'created_at' => $questionData['created_at'] ?? now(),
                    'updated_at' => $questionData['updated_at'] ?? now(),
                ]);

                foreach ($questionData['hints'] as $hint) {
                    DB::table('hints')->insert([
                        'question_id' => $questionId,
                        'level_id' => $hint['level_id'],
                        'hint_text' => $hint['hint_text'],
                        'created_at' => $hint['created_at'] ?? now(),
                        'updated_at' => $hint['updated_at'] ?? now(),
                    ]);
                }
            }
        });
    }
}
