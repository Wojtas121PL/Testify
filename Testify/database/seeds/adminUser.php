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
            'role' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        Testify\User::insert([
            'name'   => 'edit',
            'email'      => 'edit@edit',
            'password'   => Hash::make('edit'),
            'role' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        Testify\User::insert([
            'name'   => 'user',
            'email'      => 'user@user',
            'password'   => Hash::make('user'),
            'role' => 3,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
