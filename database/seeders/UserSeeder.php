<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PDOException;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(100)->create();

        // Create me too for demonstrations
        User::factory()->create([
            'name' => 'mike',
            'password' => Hash::make('demo'),
            'email' => 'longy08@hotmail.co.uk'
        ]);
    }
}
