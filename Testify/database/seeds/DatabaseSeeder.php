<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(adminUser::class);
        $this->call(ExamsTableSeeder::class);
        $this->call(ExampleResultSeeder::class);
        $this->call(QuestionsTableSeeder::class);
    }
}
