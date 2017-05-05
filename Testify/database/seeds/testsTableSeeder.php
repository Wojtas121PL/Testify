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
        App\tests::insert([
            'TestId' => 1,
            'QuestionId' => 1,
            'QuestionType' => 0,
            'Question' => 'Why does a chicken cross a road?',
            'Answers' => 'A|cuz#B|hehe#C|xddd#D|to get to the other side',
            'AnswerKey' => 4
        ]);
        App\tests::insert([
            'TestId' => 1,
            'QuestionId' => 2,
            'QuestionType' => 0,
            'Question' => 'Why does a chicken cross a road?',
            'Answers' => 'A|cuz#B|hehe#C|xddd#D|to get to the other side',
            'AnswerKey' => 4
        ]);
        App\tests::insert([
            'TestId' => 1,
            'QuestionId' => 3,
            'QuestionType' => 0,
            'Question' => 'Why does a chicken cross a road?',
            'Answers' => 'A|cuz#B|hehe#C|xddd#D|to get to the other side',
            'AnswerKey' => 4
        ]);
    }
}
