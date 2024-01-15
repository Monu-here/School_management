<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->delete();

        $datas = [
            ['type' => 'current_session', 'despc' => '2024-2025'],
            ['type' => 'term_ends', 'despc' => '7/10/2018'],
            ['type' => 'term_begins', 'despc' => '7/10/2018'],
            ['type' => 'phone', 'despc' => '0123456789'],
            ['type' => 'address', 'despc' => '18B North Central Park, Behind Central Square Tourist Center'],
        ];

        foreach ($datas as $data) {
            Setting::create($data);
        }
    }
}
