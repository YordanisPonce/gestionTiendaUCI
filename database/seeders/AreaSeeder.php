<?php

namespace Database\Seeders;

use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            ['name'=>'Direcciones centrales', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Rectorado', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Vicerrectorías', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Direcciones generales', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
            ['name'=>'Facultades', 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()],
        ];

        Area::insert($areas);
    }
}
