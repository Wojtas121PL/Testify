<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Testify\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Testify\Question::class, function (Faker\Generator $faker) {
    $answer_list = json_encode([
        1 => $faker->sentence($nbWords = 6, $variableNbWords = true),
        2 => $faker->sentence($nbWords = 6, $variableNbWords = true),
        3 => $faker->sentence($nbWords = 6, $variableNbWords = true),
        4 => $faker->sentence($nbWords = 6, $variableNbWords = true)
    ]);
    return [
        'exam_id' => $faker->numberBetween($min = 1, $max = 5),
        'question_number' => $faker->numberBetween($min = 1, $max = 5),
        'question_title' => $faker->sentence($nbWords = 15, $variableNbWords = true),
        'answer_list' => $answer_list,
        'answer_correct' => $faker->numberBetween($min = 1, $max = 4),
    ];
});

$factory->define(Testify\Exam::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence($nbWords = 15, $variableNbWords = true),
    ];
});