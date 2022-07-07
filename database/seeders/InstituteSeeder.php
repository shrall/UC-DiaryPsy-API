<?php

namespace Database\Seeders;

use App\Models\Institute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institute = new Institute();
        $institute->name = 'Tadika Mesra';
        $institute->save();

        $institute = new Institute();
        $institute->name = 'Sekolah Mawar';
        $institute->save();

        $institute = new Institute();
        $institute->name = 'Lembaga ABC';
        $institute->save();
    }
}
