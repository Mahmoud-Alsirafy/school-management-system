<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\UserTable;
use Illuminate\Database\Seeder;
use Database\Seeders\BloodTable;
use Database\Seeders\ReligionTable;
use Database\Seeders\NationalityTable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(BloodTable::class);
        $this->call(NationalityTable::class);
        $this->call(ReligionTable::class);
        $this->call(UserTable::class);
        $this->call(SpecializationsTable::class);
        $this->call(GenderTable::class);

    }
}
