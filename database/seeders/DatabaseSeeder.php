<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Products;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Products::factory(6)->create();

        // User::factory()->create([
        //     'fname' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
