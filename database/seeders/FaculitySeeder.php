<?php

namespace Database\Seeders;

use App\Models\Faculity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaculitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculities')->delete();

        $faculitys = [
            ['name' => 'BCA'],
            ['name' => 'BIT'],
            ['name' => 'CSIT'],
            ['name' => 'BBA'],
            ['name' => 'BHM'],
            ['name' => 'BSW'],
        ];

        foreach ($faculitys as $faculity) {
            Faculity::create($faculity);
        }
    }
}
