<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('games')->insert([
            'game_name' => 'قصة',
            'description' => 'لعبة اسئلة جماعية تحتوي على ٣ تلميحات ( صعب، متوسط، سهل) كل واحد منها يجعلك اقرب للوصول للإجابة
تم تطوير المحتوى ليشمل مكتبة واسعة تتجاوز 40 تصنيفاً متتوعاً، تم اختيارها بعناية لتغطي مختلف أبعاد المعرفة الإنسانية.'
        ]);
    }
}
