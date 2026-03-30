<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example seeding
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleDoctor = Role::create(['name' => 'doctor']);
        $roleScientist = Role::create(['name' => 'scientist']);

        Permission::create(['name' => 'view patients']);
        Permission::create(['name' => 'edit patients']);
        Permission::create(['name' => 'create patients']);
        Permission::create(['name' => 'delete patients']);

        Permission::create(['name' => 'view maladies']);
        Permission::create(['name' => 'edit maladies']);
        Permission::create(['name' => 'create maladies']);
        Permission::create(['name' => 'delete maladies']);

        $roleAdmin->givePermissionTo(['view patients','edit patients','create patients','delete patients', 
                                        'view maladies'
                                    ]);
        $roleDoctor->givePermissionTo([ 'view maladies']);
        $roleScientist->givePermissionTo(['view maladies','edit maladies','create maladies','delete maladies']);

    }
}
