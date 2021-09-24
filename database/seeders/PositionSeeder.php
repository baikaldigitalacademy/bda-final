<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ['php', 'devops'];
        foreach ($items as $it){
            $position = new Position();
            $position->name = $it;
            $position->save();
        }
    }
}
