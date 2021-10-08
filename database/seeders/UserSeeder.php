<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $user = new User();

        $user
            ->fill( [
                "name" => "Admin",
                "login" => "admin",
                "password" => bcrypt( "123456" ),
                "role_id" => 1
            ] )
            ->save();
    }
}
