<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('lessons')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        Lesson::insert([
            ['name' => 'Matematika', 'code' => 'MTK'],
            ['name' => 'Fisika', 'code' => 'FK'],
            ['name' => 'Bahasa Indonesia', 'code' => 'BI'],
            ['name' => 'Bahasa Inggris', 'code' => 'BIG'],
            ['name' => 'Kimia', 'code' => 'KM'],
            ['name' => 'Produktif', 'code' => 'PRD'],
        ]);
    }
}
