<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genders')->delete();
        $gender = [
            ['en'=>'Male' , 'ar' =>'ذكر'],
            ['en'=>'Female' , 'ar' =>'انثي'],
        ];
        foreach ($gender as $ge) {
            Gender::create(['Name'=> $ge]);
        }
    }
}
