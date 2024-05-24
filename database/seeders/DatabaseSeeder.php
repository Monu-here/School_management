<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BloodGroup::class);
        $this->call(classSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(StudentAttendence::class);
        $this->call(RoleSeeder::class);
        $this->call(FaculitySeeder::class);
    }
}
