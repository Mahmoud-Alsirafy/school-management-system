<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Setting extends Seeder
{
    
    public function run(): void
    {
        DB::table('settings')->delete();
        $data = [
            ['Key' => 'current_session', 'Value' => '2021-2022'],
            ['Key' => 'school_title', 'Value' => 'MS'],
            ['Key' => 'school_name', 'Value' => 'Mora Soft International Schools'],
            ['Key' => 'end_first_term', 'Value' => '01-12-2021'],
            ['Key' => 'end_second_term', 'Value' => '01-03-2022'],
            ['Key' => 'phone', 'Value' => '0123456789'],
            ['Key' => 'address', 'Value' => 'القاهرة'],
            ['Key' => 'school_email', 'Value' => 'info@morasoft.com'],
        ];

        DB::table('settings')->insert($data);
    }
}
