<?php

use Illuminate\Database\Seeder;

class ExampleResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testify\Results::getQuery()->delete();

        Testify\Results::insert([
            "TestId" => "1",
            "UserId" => "1",
            "QuestionId" => "1",
            "Answer" => "3",
            "CorrectAnswer" => "3"
        ]);
        Testify\Results::insert([
            "TestId" => "1",
            "UserId" => "1",
            "QuestionId" => "2",
            "Answer" => "1",
            "CorrectAnswer" => "4",
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}