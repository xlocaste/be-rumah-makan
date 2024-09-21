<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view rumah makan']);
        Permission::create(['name' => 'create rumah makan']);
        Permission::create(['name' => 'edit rumah makan']);
        Permission::create(['name' => 'delete rumah makan']);
        Permission::create(['name' => 'view menu']);
        Permission::create(['name' => 'create menu']);
        Permission::create(['name' => 'edit menu']);
        Permission::create(['name' => 'delete menu']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('view menu');
        $adminRole->givePermissionTo('view rumah makan');
        $adminRole->givePermissionTo('create rumah makan');
        $adminRole->givePermissionTo('edit rumah makan');
        $adminRole->givePermissionTo('delete rumah makan');

        $pemilikUsahaRole = Role::create(['name' => 'pemilikUsaha']);
        $pemilikUsahaRole->givePermissionTo('view rumah makan');
        $pemilikUsahaRole->givePermissionTo('view menu');
        $pemilikUsahaRole->givePermissionTo('create menu');
        $pemilikUsahaRole->givePermissionTo('edit menu');
        $pemilikUsahaRole->givePermissionTo('delete menu');

        $pelangganRole = Role::create(['name' => 'pelanggan']);
        $pelangganRole->givePermissionTo('view rumah makan');
        $pelangganRole->givePermissionTo('view menu');
    }
}
