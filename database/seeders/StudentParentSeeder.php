<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentParent;

class StudentParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('parents')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        StudentParent::factory(1)->create();
    }
}
