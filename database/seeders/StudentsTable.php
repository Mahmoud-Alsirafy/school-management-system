<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Grade;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Student;
use App\Models\My_Parent;
use App\Models\Type_Blood;
use App\Models\Nationality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentsTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->delete();
        
        Student::create([
            'name' =>  [ "ar"=>'محمود', "en"=>"mahmoud"],
            'email' => "Mahmoud@gmail.com",
            'password' => Hash::make('123456789mM$'),
            'Grade_id' => Grade::all()->unique()->random()->id,
            'Classroom_id' => Room::all()->unique()->random()->id,
            'gender_id' => Gender::all()->unique()->random()->id,
            'nationalitie_id' => Nationality::all()->unique()->random()->id,
            'section_id' => Section::all()->unique()->random()->id,
            'parent_id' => My_Parent::all()->unique()->random()->id,
            'blood_id' => Type_Blood::all()->unique()->random()->id,
            "academic_year"=>"2025",
            "Date_Birth"=> date('1995-01-01'),
        ]);
    }
}
