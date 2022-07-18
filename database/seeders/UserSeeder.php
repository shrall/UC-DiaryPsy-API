<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Marcel";
        $user->email = "user@gmail.com";
        $user->password = Hash::make('wars1234');
        $user->year_born = 2000;
        $user->phone = "08123123123";
        $user->address = "Jl. Mawar 123";
        $user->institute_id = 1;
        $user->religion_id = 1;
        $user->tribe_id = 1;
        $user->city_id = 1101;
        $user->role_id = 1;
        $user->save();

        $user = new User();
        $user->name = "Super Admin";
        $user->email = "superadmin@gmail.com";
        $user->password = Hash::make('wars1234');
        $user->year_born = 2000;
        $user->phone = "08123123123";
        $user->address = "Jl. Mawar 123";
        $user->institute_id = 1;
        $user->religion_id = 1;
        $user->tribe_id = 1;
        $user->city_id = 1101;
        $user->role_id = 2;
        $user->save();

        $user = new User();
        $user->name = "Admin";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make('wars1234');
        $user->year_born = 2000;
        $user->phone = "08123123123";
        $user->address = "Jl. Mawar 123";
        $user->institute_id = 1;
        $user->religion_id = 1;
        $user->tribe_id = 1;
        $user->city_id = 1101;
        $user->role_id = 2;
        $user->save();
    }
}
