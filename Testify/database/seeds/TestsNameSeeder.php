<?php

use Illuminate\Database\Seeder;

class TestsNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testify\TestsName::getQuery()->delete();
        Testify\TestsName::insert([
            'Id' => 1,
            'Name' => 'Why does chicken cross road ??'
        ]);
        Testify\TestsName::insert([
            'Id' => 2,
            'Name' => 'Why does dog cross road ??'
        ]);
    }
}
