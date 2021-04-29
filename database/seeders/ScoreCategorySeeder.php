<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScoreCategory;

class ScoreCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('score_categories')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        ScoreCategory::insert([
            ['name' => 'Harian 1'],
            ['name' => 'Harian 2'],
            ['name' => 'Harian 3'],
            ['name' => 'Praktikum 1'],
            ['name' => 'Praktikum 2'],
            ['name' => 'UTS'],
            ['name' => 'UAS'],
        ]);
    }
}
