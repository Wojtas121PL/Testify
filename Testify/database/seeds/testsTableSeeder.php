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
        Testify\tests::getQuery()->delete();

        Testify\tests::insert([
            'TestId' => 1,
            'QuestionId' => 1,
            'QuestionType' => 0,
            'Question' => 'Why does a chicken cross a road?',
            'Answers' => json_encode([
                "A" => "Yes",
                "B" => "No",
                "C" => "Chicken is stupid",
                "D" => "I eat its for dinner",
            ]),
            'AnswerKey' => 4
        ]);
        Testify\tests::insert([
            'TestId' => 1,
            'QuestionId' => 2,
            'QuestionType' => 0,
            'Question' => 'Why does a dog cross a road?',
            'Answers' => json_encode([
                "A" => "Yes",
                "B" => "No",
                "C" => "Dog is stupid",
                "D" => "I eat its for dinner",
            ]),
            'AnswerKey' => 4
        ]);
        Testify\tests::insert([
            'TestId' => 2,
            'QuestionId' => 1,
            'QuestionType' => 0,
            'Question' => 'Why does a fish cross a road?',
            'Answers' => json_encode([
                "A" => "Yes",
                "B" => "No",
                "C" => "Fish is stupid",
                "D" => "I eat its for dinner",
            ]),
            'AnswerKey' => 4
        ]);
        Testify\tests::insert([
            'TestId' => 2,
            'QuestionId' => 2,
            'QuestionType' => 0,
            'Question' => 'Why does a cat cross a road?',
            'Answers' => json_encode([
                "A" => "Yes",
                "B" => "No",
                "C" => "Cat is stupid",
                "D" => "I eat its for dinner",
            ]),
            'AnswerKey' => 4
        ]);
    }
}
