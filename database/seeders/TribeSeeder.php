<?php

namespace Database\Seeders;

use App\Models\Tribe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tribe = new Tribe();
        $tribe->name = 'Jawa';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Sunda';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Sulawesi';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Madura';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Betawi';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Minangkabau';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Bugis';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Melayu';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Sumatra Selatan';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Banten';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'NTT';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Banjar';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Aceh';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Bali';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Sasak';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Dayak';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Tionghoa';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Papua';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Makassar';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Sumatra';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Maluku';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Kalimantan';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Cirebon';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Jambi';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Lampung';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'NTB';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Gorontalo';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Minahasa';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Nias';
        $tribe->save();

        $tribe = new Tribe();
        $tribe->name = 'Warga Asing';
        $tribe->save();
    }
}
