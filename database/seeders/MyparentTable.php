<?php

namespace Database\Seeders;

use App\Models\Religion;
use App\Models\My_Parent;
use App\Models\Type_Blood;
use App\Models\Nationality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MyparentTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('my__parents')->delete();

          My_Parent::create([

              'email' => 'mahmoud@gmail.com',
              'password' => Hash::make('123456789mM$'),
              // father
            'Name_Father' => 'mahmoud',
            'Job_Father'=>"web dev",
            'National_ID_Father'=>"123456789123",
            'Passport_ID_Father'=>"12315442386413",
            'Phone_Father'=>"01068492403",
            'Nationality_Father_id' => Nationality::all()->unique()->random()->id,
            'Blood_Type_Father_id' => Type_Blood::all()->unique()->random()->id,
            'Religion_Father_id' => Religion::all()->unique()->random()->id,
            "Address_Father"=>"sarqia egypt",

            // mather

             'Name_Mother' => 'maryam',
            'Job_Mother'=>"web dev",
            'National_ID_Mother'=>"123456789123",
            'Passport_ID_Mother'=>"12315442386413",
            'Phone_Mother'=>"01068492403",
            'Nationality_Mother_id' => Nationality::all()->unique()->random()->id,
            'Blood_Type_Mother_id' => Type_Blood::all()->unique()->random()->id,
            'Religion_Mother_id' => Religion::all()->unique()->random()->id,
            "Address_Mother"=>"sarqia egypt",
        ]);
    }
}
