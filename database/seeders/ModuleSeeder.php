<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = new Module();
        $module->name = "Kasih";
        $module->order = 1;
        $module->color_hex = "#ffffff";
        $module->save();

        $module = new Module();
        $module->name = "Sukacita";
        $module->order = 2;
        $module->color_hex = "#ffffff";
        $module->save();

        $module = new Module();
        $module->name = "Damai Sejahtera";
        $module->order = 3;
        $module->color_hex = "#ffffff";
        $module->save();

        $module = new Module();
        $module->name = "Kesabaran";
        $module->order = 4;
        $module->color_hex = "#ffffff";
        $module->save();

        $module = new Module();
        $module->name = "Kemurahan";
        $module->order = 5;
        $module->color_hex = "#ffffff";
        $module->save();

        $module = new Module();
        $module->name = "Kebaikan";
        $module->order = 6;
        $module->color_hex = "#ffffff";
        $module->save();

        $module = new Module();
        $module->name = "Kesetiaan";
        $module->order = 7;
        $module->color_hex = "#ffffff";
        $module->save();

        $module = new Module();
        $module->name = "Kelemahlembutan";
        $module->order = 8;
        $module->color_hex = "#ffffff";
        $module->save();

        $module = new Module();
        $module->name = "Penguasaan Diri";
        $module->order = 9;
        $module->color_hex = "#ffffff";
        $module->save();
    }
}
