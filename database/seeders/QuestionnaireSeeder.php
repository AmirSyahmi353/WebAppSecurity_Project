<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questionnaires')->insert([
        'question' => 'How much do you crave this chocolate bar?',
        'image_path' => 'images/questionnaire/chocolate.jpg',
        ]);
    }
}
