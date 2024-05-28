<?php

namespace Database\Seeders;

use App\Models\Attendence;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;


class StudentAttendence extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        Attendence::query()->truncate();
        $studentList = Student::all();
        foreach ($studentList as $student) {
            // $m = date('m');
            for ($m = 1; $m <= 1; $m++) {
                for ($d = 1; $d <= 5; $d++) {
                    if ($d <= 9) {
                        $d = '0' . $d;
                    }
                    $str = date('Y') . '-' . $m . '-' . $d;
                    if ($d % 3 == 0) {
                        $status = 'A'; //Abasent
                    } elseif ($d % 3 == 1) {
                        $status = 'L'; // Leave
                    } else {
                        $status = 'P'; //Present
                    }
                    if ($m == 2 && $d == 28) {
                        break;
                    }

                    $sa                  = new Attendence();
                    $sa->student_id      = $student->id;
                    $sa->attendance_type = $status;
                    $sa->faculity_id = $student->faculity_id;
                    $sa->notes           = 'Sample Attendance for ' . $str;
                    $sa->attendance_date = $str;
                    $sa->save();
                }
            }
        }
    }
}
