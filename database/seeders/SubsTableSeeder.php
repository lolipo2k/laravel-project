<?php

namespace Database\Seeders;

use App\Models\Sub;
use Illuminate\Database\Seeder;


class SubsTableSeeder extends Seeder
{
    public function run()
    {
        Sub::create([
            'title' => 'Raz w tygodniu',
            'percent' => '15'
        ]);

        Sub::create([
            'title' => 'Raz w miesiącu',
            'percent' => '5'
        ]);

        Sub::create([
            'title' => 'Raz na dwa tygodnie',
            'percent' => '10'
        ]);
    }
}
