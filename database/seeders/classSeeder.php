<?php

namespace Database\Seeders;

use App\Models\Classs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class classSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classses')->delete();

        $classes = [
            ['name' => 'Sem 1'],
            ['name' => 'Sem 2'],
            ['name' => 'Sem 3'],
            ['name' => 'Sem 4'],
            ['name' => 'Sem 5'],
            ['name' => 'Sem 6'],
            ['name' => 'Sem 7'],
            ['name' => 'Sem 8'],
            ['name' => 'Sem 9'],
            ['name' => 'Sem 10'],
        ];

        foreach ($classes as $class) {
            Classs::create($class);
        }
    }
}
