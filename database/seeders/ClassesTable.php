<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassesTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Classrooms')->delete();
        $classrooms = [
            ['en' => 'First grade', 'ar' => 'الصف الاول'],
            ['en' => 'Second grade', 'ar' => 'الصف الثاني'],
            ['en' => 'Third grade', 'ar' => 'الصف الثالث'],
        ];

        foreach ($classrooms as $classroom) {
            Room::create([
                'Name_Class' => $classroom,
                'Grade_id' => Grade::all()->unique()->random()->id
            ]);
        }
    }
}
