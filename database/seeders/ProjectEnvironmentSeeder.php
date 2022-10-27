<?php

namespace Database\Seeders;

use App\Models\ProjectEnvironment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectEnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $env = new ProjectEnvironment();
        $env->status = 'dev';
        $env->save();
    }
}
