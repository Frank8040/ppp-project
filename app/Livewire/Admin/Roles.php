<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Usernotnull\Toast\Concerns\WireToast;

class Roles extends Component
{
    use WithPagination;
    use WireToast;

    public $isOpen = false, $isOpenAssign = false;
    public $roleId, $role;
    public $listPermissions = [];

    #[Rule('required|min:3')]
    public $name;

    public function render()
    {
        $roles = Role::all();
        $permissions = Permission::all()->groupBy('section');
        return view('livewire.admin.roles', compact('roles', 'permissions'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->reset('roleId', 'role', 'name');
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();
        if (!isset($this->roleId)) {
            $role = Role::create(['name' => $this->name, 'guard_name' => 'web']);
            toast()->success('Registro creado correctamente', 'Mensaje de éxito')->push();
        } else {
            $role = Role::find($this->roleId);
            $role->update(['name' => $this->name]);
            toast()->success('Registro actualizado correctamente', 'Mensaje de éxito')->push();
        }
        $this->reset(['isOpen', 'roleId', 'role']);

    }

    public function edit(Role $role)
    {
        $this->reset('roleId', 'role', 'name');
        $this->isOpen = true;
        $this->role = $role;
        $this->roleId = $role->id;
        $this->name = $role->name;
    }

    public function delete($id)
    {
        Role::where('id', $id)->delete();
    }

    public function showPermissions(Role $role)
    {
        $this->isOpenAssign = true;
        $this->role = $role;
        $this->listPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function updateRolePermissions(Role $role)
    {
        $isNewAssignment = $role->permissions()->count() === 0;

        if ($isNewAssignment && empty($this->listPermissions)) {
            toast()->danger('No se puede asignar permisos vacíos', 'Mensaje de error')->push();
        } else {
            $role->permissions()->sync($this->listPermissions);
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
            if ($isNewAssignment && $this->listPermissions) {
                toast()->success('Se asignó correctamente los permisos', 'Mensaje de éxito')->push();
            } else if (!$isNewAssignment) {
                toast()->success('Se actualizó correctamente los permisos', 'Mensaje de éxito')->push();
            }
        }
        $this->reset(['isOpenAssign', 'role']);
    }

    public function closeModals()
    {
        $this->isOpen = false;
        $this->isOpenAssign = false;
    }
}
