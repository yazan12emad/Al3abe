<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            [
                'id' => 1,
                'level_name' => 'Hard',
                'number' => 1
            ],
            [
                'id' => 2,
                'level_name' => 'Medium',
                'number' => 2
            ],
            [
                'id' => 3,
                'level_name' => 'Easy',
                'number' => 2

            ],
        ]);
    }
}
