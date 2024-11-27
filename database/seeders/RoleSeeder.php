<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Super-admin']);
        $role2 = Role::create(['name' => 'Administrador']);
        $role3 = Role::create(['name' => 'Secretaría']);
        $role4 = Role::create(['name' => 'Usuario']);

        $role5 = Role::create(['name' => 'Supervisor']);

        Permission::create(['name' => 'admin.home', 'section' => 'Estadística', 'description' => 'Ver dashboard'])->syncRoles([$role1, $role2, $role3, $role4]);

        Permission::create(['name' => 'admin.manage.profile', 'section' => 'Configuración', 'description' => 'Administrar perfil personal'])->syncRoles([$role1, $role2, $role3, $role4]);

        Permission::create(['name' => 'admin.roles', 'section' => 'Roles', 'description' => 'Ver listado de roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create', 'section' => 'Roles', 'description' => 'Crear roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit', 'section' => 'Roles', 'description' => 'Editar roles'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.assign-permission', 'section' => 'Roles', 'description' => 'Asignar permisos al rol'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.users', 'section' => 'Usuarios', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.show', 'section' => 'Usuarios', 'description' => 'Ver detalle del usuario'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.users.create', 'section' => 'Usuarios', 'description' => 'Crear usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'section' => 'Usuarios', 'description' => 'Editar usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.delete', 'section' => 'Usuarios', 'description' => 'Eliminar usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.assign-role', 'section' => 'Usuarios', 'description' => 'Asignar roles al usuario'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.monitor', 'section' => 'Monitorear', 'description' => 'Monitorear PPP'])->syncRoles([$role2, $role3]);
        Permission::create(['name' => 'admin.register-ppp', 'section' => 'Registrar', 'description' => 'Registrar PPP'])->syncRoles([$role2, $role3]);
    }
}
