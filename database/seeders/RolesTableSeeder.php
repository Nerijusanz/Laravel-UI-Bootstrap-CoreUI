<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{

    public function run(): void
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
                'created_at' => now()
            ],
            [
                'id'    => 2,
                'title' => 'User',
                'created_at' => now()
            ],

        ];

        Role::insert($roles);
    }
}
