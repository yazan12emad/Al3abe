<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonDateFile = file_get_contents(database_path('Json_files/Data/CategoriesData.json'));
        $categories = json_decode($jsonDateFile, true);
        DB::table('categories')->insert($categories);
    }
}
