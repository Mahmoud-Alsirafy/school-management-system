<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->delete();



        Teacher::create([
            'Name' =>["ar" => 'محمود', "en" => "mahmoud"],
            'email' => "Mahmoud@gmail.com",
            'password' => Hash::make('123456789mM$'),
            'Specialization_id' => Specialization::all()->unique()->random()->id,
            'Gender_id' => Gender::all()->unique()->random()->id,
            'Address' => "Sharqia",
            'Joining_Date' => '1995-01-01',
        ]);
    }
}
