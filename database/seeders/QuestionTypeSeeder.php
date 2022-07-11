<?php

namespace Database\Seeders;

use App\Models\QuestionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new QuestionType();
        $type->name = 'Berhasil/Gagal';
        $type->save();

        $type = new QuestionType();
        $type->name = 'Pertanyaan Terbuka';
        $type->save();

        $type = new QuestionType();
        $type->name = 'Refleksi';
        $type->save();
    }
}
