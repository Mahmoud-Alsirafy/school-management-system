<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionsTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Sections')->delete();
        $sections = [
            ['en' => 'a', 'ar' => 'ا'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ت'],
        ];

        foreach ($sections as $section) {
            Section::create([
                'Name_Section' => $section,
                'Status' => 1,
                'Grade_id' => Grade::all()->unique()->random()->id,
                'Classroom_id' => Room::all()->unique()->random()->id,
            ]);
        }
        DB::table('teacher_section')->insert([
            'teacher_id' => Teacher::all()->unique()->random()->id,
            'Section_id' =>  Section::all()->unique()->random()->id,

        ]);
    }
}
