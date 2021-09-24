<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Summary;

class SummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $factory = Summary::factory();
        $n = 100;

        for($i = 0; $i < $n; $i++){
            $summary = $factory->makeOne();
            $summary->order = $i + 1;
            $summary->save();
        }
    }
}
