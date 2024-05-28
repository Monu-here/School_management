<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pers = ['edit-post', 'delete-post', 'view-post'];
        foreach ($pers as $per) {
            Permission::create([
                'name' => $per,
            ]);
        }
    }
}
