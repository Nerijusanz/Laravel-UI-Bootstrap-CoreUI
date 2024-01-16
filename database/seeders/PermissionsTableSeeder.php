<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{

    public function run(): void
    {

        $i                = 1;
        $permissions      = [];
        $permissionGroups = [
            'permission', 'role', 'user'
        ];

        foreach ($permissionGroups as $permissionGroup) {
            foreach (['access', 'create', 'edit', 'show', 'delete'] as $permission) {
                $permissions[] = [
                    'id'    => $i++,
                    'title' => $permissionGroup . '_management_' . $permission,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        Permission::insert($permissions);

    }
}
