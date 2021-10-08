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
        $items = [
            [ "назначено собеседование", null ],
            [ "отказ", "#f5c4c5" ],
            [ "одобрен", "#d3e7cd" ],
            [ "слился", null ]
        ];

        foreach( $items as [ $name, $color ] ){
            $position = new SummaryStatus();

            $position->name = $name;
            $position->color = $color;

            $position->save();
        }
    }
}
