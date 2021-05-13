<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //developer@admin.com/password
        $this->createUser('developer', 'super-admin'); 
        $this->createUser('admin', 'admin');
        $this->createUser('user', 'user');
    }

    public function createUser($username, $role, $password = 'password')
    {
        $user = User::create([
            'name' => Str::title($username),
            'email' => $username . '@admin.com',
            'password' => bcrypt("$password"),
        ]);

        $user->assignRole($role);
    }
}


    

