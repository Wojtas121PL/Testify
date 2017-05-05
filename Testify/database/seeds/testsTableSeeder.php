<?php

use Illuminate\Database\Seeder;

class testsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\tests::getQuery()->delete();

        App\tests::insert([
            'TestId' => 1,
            'QuestionId' => 1,
            'QuestionType' => 0,
            'Question' => 'Why does a chicken cross a road?',
            'Answers' => json_encode([
                "A" => "asdas",
                "B" => "sasgoiaj",
                "C" => "sasgoiaj",
                "D" => "sasgoiaj",
            ]),
            'AnswerKey' => 4
        ]);
        App\tests::insert([
            'TestId' => 1,
            'QuestionId' => 2,
            'QuestionType' => 0,
            'Question' => 'Why does a chicken cross a road?',
            'Answers' => json_encode([
                "A" => "asdas",
                "B" => "sasgoiaj",
                "C" => "sasgoiaj",
                "D" => "sasgoiaj",
            ]),
            'AnswerKey' => 4
        ]);
        App\tests::insert([
            'TestId' => 2,
            'QuestionId' => 1,
            'QuestionType' => 0,
            'Question' => 'Why does a chicken cross a road?',
            'Answers' => json_encode([
                "A" => "asdas",
                "B" => "sasgoiaj",
                "C" => "sasgoiaj",
                "D" => "sasgoiaj",
            ]),
            'AnswerKey' => 4
        ]);
        App\tests::insert([
            'TestId' => 2,
            'QuestionId' => 2,
            'QuestionType' => 0,
            'Question' => 'Why does a chicken cross a road?',
            'Answers' => json_encode([
                "A" => "asdas",
                "B" => "sasgoiaj",
                "C" => "sasgoiaj",
                "D" => "sasgoiaj",
            ]),
            'AnswerKey' => 4
        ]);
    }
}
