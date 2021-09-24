<?php

namespace Database\Seeders;

use App\Models\SummaryStatus;
use Illuminate\Database\Seeder;


class SummaryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = ["назначено собеседование", "отказ", "одобрен", "слился"];
        foreach ($items as $it){
            $position = new SummaryStatus();
            $position->name = $it;
            $position->save();
        }
    }
}
