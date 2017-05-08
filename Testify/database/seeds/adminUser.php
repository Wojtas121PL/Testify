<?php

use Illuminate\Database\Seeder;

class adminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testify\User::getQuery()->delete();

        Testify\User::insert([
            'name'   => 'root',
            'email'      => 'root@root',
            'password'   => Hash::make('root'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

    }
}
