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
            ['name' => 'Nursery'],
            ['name' => 'LKG'],
            ['name' => 'UKG'],
            ['name' => 'ONE'],
            ['name' => 'TWO'],
            ['name' => 'THREE'],
            ['name' => 'FOUR'],
            ['name' => 'FIVE'],
            ['name' => 'SIX'],
            ['name' => 'SEVEN'],
            ['name' => 'EIGHT'],
            ['name' => 'NINE'],
            ['name' => 'TEN'],
        ];

        foreach ($classes as $class) {
            Classs::create($class);
        }
    }
}
