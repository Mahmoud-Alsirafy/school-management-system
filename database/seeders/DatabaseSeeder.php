<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\UserTable;
use Illuminate\Database\Seeder;
use Database\Seeders\BloodTable;
use Database\Seeders\ReligionTable;
use Database\Seeders\NationalityTable;
use Database\Seeders\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call(BloodTable::class);
        $this->call(NationalityTable::class);
        $this->call(ReligionTable::class);
        $this->call(UserTable::class);
        $this->call(SpecializationsTable::class);
        $this->call(GenderTable::class);
        $this->call(GradeTable::class);
        $this->call(ClassesTable::class);
        $this->call(TeacherTable::class);
        $this->call(SectionsTable::class);
        $this->call(MyparentTable::class);
        $this->call(StudentsTable::class);
        $this->call(Setting::class);


    }
}
