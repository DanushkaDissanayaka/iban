<?php

namespace Database\Seeders;

use App\Models\Iban;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class IbanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        foreach (range(1, 1000) as $index) {
            Iban::create([
                'number' => $faker->iban(),
                'user_id' => $user->id
            ]);
        }
    }
}
