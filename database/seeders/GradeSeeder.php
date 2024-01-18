<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->delete();
        $grades = [
            ['name' => 'A+', 'mark_from' => 90, 'mark_to' => 100, 'remark' => 'Outstanding'],
            ['name' => 'A', 'mark_from' => 80, 'mark_to' => 90, 'remark' => 'Excellent'],
            ['name' => 'B+', 'mark_from' => 70, 'mark_to' => 80, 'remark' => 'Very Good'],
            ['name' => 'B', 'mark_from' => 60, 'mark_to' => 70, 'remark' => 'Good'],
            ['name' => 'C+', 'mark_from' => 50, 'mark_to' => 60, 'remark' => 'Satisfactory'],
            ['name' => 'C', 'mark_from' => 40, 'mark_to' => 50, 'remark' => 'Acceptable'],
            ['name' => 'D', 'mark_from' => 35, 'mark_to' => 40, 'remark' => 'Basic'],
            ['name' => 'NG', 'mark_from' => 0, 'mark_to' =>  35, 'remark' => 'Not Grade'],
        ];
        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}
