<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list estadoretiros']);
        Permission::create(['name' => 'view estadoretiros']);
        Permission::create(['name' => 'create estadoretiros']);
        Permission::create(['name' => 'update estadoretiros']);
        Permission::create(['name' => 'delete estadoretiros']);

        Permission::create(['name' => 'list clientes']);
        Permission::create(['name' => 'view clientes']);
        Permission::create(['name' => 'create clientes']);
        Permission::create(['name' => 'update clientes']);
        Permission::create(['name' => 'delete clientes']);

        Permission::create(['name' => 'list atributos']);
        Permission::create(['name' => 'view atributos']);
        Permission::create(['name' => 'create atributos']);
        Permission::create(['name' => 'update atributos']);
        Permission::create(['name' => 'delete atributos']);

        Permission::create(['name' => 'list tipoevidencias']);
        Permission::create(['name' => 'view tipoevidencias']);
        Permission::create(['name' => 'create tipoevidencias']);
        Permission::create(['name' => 'update tipoevidencias']);
        Permission::create(['name' => 'delete tipoevidencias']);

        Permission::create(['name' => 'list bloquehorarios']);
        Permission::create(['name' => 'view bloquehorarios']);
        Permission::create(['name' => 'create bloquehorarios']);
        Permission::create(['name' => 'update bloquehorarios']);
        Permission::create(['name' => 'delete bloquehorarios']);

        Permission::create(['name' => 'list modificaciones']);
        Permission::create(['name' => 'view modificaciones']);
        Permission::create(['name' => 'create modificaciones']);
        Permission::create(['name' => 'update modificaciones']);
        Permission::create(['name' => 'delete modificaciones']);

        Permission::create(['name' => 'list evidencias']);
        Permission::create(['name' => 'view evidencias']);
        Permission::create(['name' => 'create evidencias']);
        Permission::create(['name' => 'update evidencias']);
        Permission::create(['name' => 'delete evidencias']);

        Permission::create(['name' => 'list retiros']);
        Permission::create(['name' => 'view retiros']);
        Permission::create(['name' => 'create retiros']);
        Permission::create(['name' => 'update retiros']);
        Permission::create(['name' => 'delete retiros']);

        Permission::create(['name' => 'list agendas']);
        Permission::create(['name' => 'view agendas']);
        Permission::create(['name' => 'create agendas']);
        Permission::create(['name' => 'update agendas']);
        Permission::create(['name' => 'delete agendas']);

        Permission::create(['name' => 'list estadoagendas']);
        Permission::create(['name' => 'view estadoagendas']);
        Permission::create(['name' => 'create estadoagendas']);
        Permission::create(['name' => 'update estadoagendas']);
        Permission::create(['name' => 'delete estadoagendas']);

        Permission::create(['name' => 'list bitacoras']);
        Permission::create(['name' => 'view bitacoras']);
        Permission::create(['name' => 'create bitacoras']);
        Permission::create(['name' => 'update bitacoras']);
        Permission::create(['name' => 'delete bitacoras']);

        Permission::create(['name' => 'list estadollamados']);
        Permission::create(['name' => 'view estadollamados']);
        Permission::create(['name' => 'create estadollamados']);
        Permission::create(['name' => 'update estadollamados']);
        Permission::create(['name' => 'delete estadollamados']);

        Permission::create(['name' => 'list llamados']);
        Permission::create(['name' => 'view llamados']);
        Permission::create(['name' => 'create llamados']);
        Permission::create(['name' => 'update llamados']);
        Permission::create(['name' => 'delete llamados']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
