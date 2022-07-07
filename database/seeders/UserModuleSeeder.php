<?php

namespace Database\Seeders;

use App\Models\UserModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $um = new UserModule();
        $um->user_id = 1;
        $um->module_id = 1;
        $um->status = 1;
        $um->save();

        $um = new UserModule();
        $um->user_id = 1;
        $um->module_id = 2;
        $um->status = 0;
        $um->save();
    }
}
