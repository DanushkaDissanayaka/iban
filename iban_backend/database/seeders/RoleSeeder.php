<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            [
                'id' => config('config.role.admin'),
                'name' => 'Admin'
            ],
            [
                'id' => config('config.role.user'),
                'name' => 'User'
            ]
        ]);
    }
}
