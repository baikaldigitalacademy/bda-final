<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ["intern", "junior", "middle", "senior"];
        foreach ($items as $it){
            $position = new Level();
            $position->name = $it;
            $position->save();
        }
    }
}
