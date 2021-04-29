<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('classes')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        Grade::insert([
            ['name' => 10, 'sub' => 1],
            ['name' => 10, 'sub' => 2],
            ['name' => 11, 'sub' => 1],
            ['name' => 11, 'sub' => 2],
            ['name' => 12, 'sub' => 1],
            ['name' => 12, 'sub' => 2],
        ]);
    }
}
