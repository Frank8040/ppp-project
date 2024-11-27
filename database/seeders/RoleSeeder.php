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

        Permission::create(['name' => 'admin.home', 'section' => 'Estadística', 'description' => 'Ver dashboard'])->syncRoles([$role1, $role2, $role3, $role4]);

        Permission::create(['name' => 'admin.manage.profile', 'section' => 'Configuración', 'description' => 'Administrar perfil personal'])->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name' => 'admin.manage.yape', 'section' => 'Configuración', 'description' => 'Administrar cuenta Yape'])->syncRoles([$role1]);

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

        Permission::create(['name' => 'admin.categories', 'section' => 'Categorias', 'description' => 'Ver listado de categorias'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.categories.show', 'section' => 'Categorias', 'description' => 'Ver detalle de categoria'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.categories.create', 'section' => 'Categorias', 'description' => 'Crear categorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.edit', 'section' => 'Categorias', 'description' => 'Editar categorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.delete', 'section' => 'Categorias', 'description' => 'Eliminar categorias'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.products', 'section' => 'Productos', 'description' => 'Ver listado de productos'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.products.show', 'section' => 'Productos', 'description' => 'Ver detalle de producto'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.products.create', 'section' => 'Productos', 'description' => 'Crear productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.products.edit', 'section' => 'Productos', 'description' => 'Editar productos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.products.delete', 'section' => 'Productos', 'description' => 'Eliminar productos'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.monitor', 'section' => 'Monitorear', 'description' => 'Monitorear PPP'])->syncRoles([$role2, $role3]);
        Permission::create(['name' => 'admin.register-ppp', 'section' => 'Registrar', 'description' => 'Registrar PPP'])->syncRoles([$role3]);
    }
}
