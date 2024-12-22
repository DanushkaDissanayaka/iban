<?php

namespace Database\Seeders;

use App\Models\Iban;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class IbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        $user = User::factory()->create([
            'name' => 'Seed User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role_id' => config('config.role.admin'),
        ]);

        foreach (range(1, 1000) as $index) {
            Iban::create([
                'number' => $faker->iban(),
                'user_id' => $user->id
            ]);
        }
    }
}
