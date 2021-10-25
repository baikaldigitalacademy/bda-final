<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        ( new RoleSeeder() )->run();
        ( new UserSeeder() )->run();
        (new PositionSeeder())->run();
        (new SummaryStatusSeeder())->run();
        (new LevelSeeder())->run();
        (new SummarySeeder())->run();
    }
}
