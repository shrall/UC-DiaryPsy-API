<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $education = new Education();
        $education->name = 'Tidak Sekolah';
        $education->save();

        $education = new Education();
        $education->name = 'SD';
        $education->save();

        $education = new Education();
        $education->name = 'SMP';
        $education->save();

        $education = new Education();
        $education->name = 'SMA/Sederajat';
        $education->save();

        $education = new Education();
        $education->name = 'Diploma';
        $education->save();

        $education = new Education();
        $education->name = 'D3/S1';
        $education->save();

        $education = new Education();
        $education->name = 'S2';
        $education->save();

        $education = new Education();
        $education->name = 'S3';
        $education->save();
    }
}
