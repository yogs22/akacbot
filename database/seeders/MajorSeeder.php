<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Major;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \Illuminate\Support\Facades\DB::table('majors')->truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        Major::insert([
            ['name' => 'Rekayasa Perangkat Lunak', 'code' => 'RPL'],
            ['name' => 'Teknik Kendaraan Ringan', 'code' => 'TKR'],
            ['name' => 'Teknik Pengolaan Hasil Pertanian', 'code' => 'TPHP'],
            ['name' => 'Teknik Otomotif', 'code' => 'TO'],
            ['name' => 'Teknik Komputer Jaringan', 'code' => 'TKJ'],
        ]);
    }
}
