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
        ];

        foreach ($datas as $data) {
            Setting::create($data);
        }
    }
}
