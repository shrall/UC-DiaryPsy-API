<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $religion = new Religion();
        $religion->name = 'Islam';
        $religion->save();

        $religion = new Religion();
        $religion->name = 'Katolik';
        $religion->save();

        $religion = new Religion();
        $religion->name = 'Kristen';
        $religion->save();

        $religion = new Religion();
        $religion->name = 'Hindu';
        $religion->save();

        $religion = new Religion();
        $religion->name = 'Buddha';
        $religion->save();

        $religion = new Religion();
        $religion->name = 'Kong Hu Chu';
        $religion->save();

        $religion = new Religion();
        $religion->name = 'Lainnya';
        $religion->save();
    }
}
