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
        $password = bcrypt( "123456" );

        $data = [
            [
                "name" => "Admin",
                "login" => "admin",
                "password" => $password,
                "role_id" => 1
            ],
            [
                "name" => "HR",
                "login" => "hr",
                "password" => $password,
                "role_id" => 2
            ],
            [
                "name" => "FroZo",
                "login" => "frozo",
                "password" => $password,
                "role_id" => 1
            ],
            [
                "name" => "Salriel",
                "login" => "salriel",
                "password" => $password,
                "role_id" => 1
            ],
            [
                "name" => "Карина",
                "login" => "pkarina",
                "password" => $password,
                "role_id" => 1
            ],
            [
                "name" => "Слава",
                "login" => "Slava200",
                "password" => $password,
                "role_id" => 1
            ]
        ];

        foreach( $data as $userFields ){
            ( new User() )->fill( $userFields )->save();
        }
    }
}
