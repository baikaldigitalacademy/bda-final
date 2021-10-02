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
            [ "отказ", "rgb( 245, 196, 197 )" ],
            [ "одобрен", "rgb( 211, 231, 205 )" ],
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
