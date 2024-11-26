<?php

namespace App\Livewire\Admin;

use App\Events\UserCreated;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Usernotnull\Toast\Concerns\WireToast;

class Users extends Component
{
    use WithPagination;
    use WireToast;

    public $search;
    public $isOpen = false, $isOpenAssign = false, $showUser = false, $isOpenDelete = false;
    public $itemId, $userState, $userRol;
    public UserForm $form;
    public ?User $user;
    public $roles, $listRoles = [];

    public function refreshUsers()
    {
        $this->render();
    }

    public function render()
    {
        $this->roles = Role::all();
        $users = User::query()
            ->where(function ($query) {
                $query->where('dni', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('surnames', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->userState !== null, function ($query) {
                $query->where('status', $this->userState);
            })
            ->when($this->userRol, function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('id', $this->userRol);
                });
            })
            ->latest('id')
            ->paginate(10);

        return view('livewire.admin.users', compact('users'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function edit(User $user)
    {
        $this->resetForm();
        $this->isOpen = true;
        $this->itemId = $user->id;
        $this->user = $user;
        $this->form->fill($user);
    }

    public function store()
    {
        $this->validate();
        $userData = $this->form->toArray();
        if (!isset($this->user->id)) {
            $userData['password'] = bcrypt($this->form->password);
            User::create($userData);
            toast()->success('Usuario creado correctamente', 'Mensaje de éxito')->push();
        } else {
            if (!empty($this->form->password)) {
                $userData['password'] = bcrypt($this->form->password);
            } else {
                unset($userData['password']);
            }
            $this->user->update($userData);
            event(new UserCreated($userData));
            toast()->success('Usuario actualizado correctamente', 'Mensaje de éxito')->push();
        }
        $this->closeModals();
    }

    public function deleteItem($id)
    {
        $this->itemId = $id;
        $this->isOpenDelete = true;
    }

    public function delete()
    {
        $user = User::find($this->itemId)->delete();
        toast()->success('Usuario eliminado correctamente', 'Mensaje de éxito')->push();
        event(new UserCreated($user));
        $this->reset('isOpenDelete', 'itemId');
    }

    public function showRoles(User $user)
    {
        $this->isOpenAssign = true;
        $this->user = $user;
        $this->listRoles = $user->roles->pluck('id')->toArray();
    }

    public function showUserDetail(User $user)
    {
        $this->showUser = true;
        $this->edit($user);
    }

    public function updateRoleUser(User $user)
    {
        $isNewAssignment = $user->roles()->count() === 0;
        if ($isNewAssignment && empty($this->listRoles)) {
            toast()->danger('No se puede asignar roles vacíos', 'Mensaje de error')->push();
        } else {
            $user->roles()->sync($this->listRoles);
            if ($isNewAssignment && $this->listRoles) {
                toast()->success('Se asignaron correctamente los roles', 'Mensaje de éxito')->push();
            } else if (!$isNewAssignment) {
                toast()->success('Se actualizaron correctamente los roles', 'Mensaje de éxito')->push();
            }
        }
        $this->reset(['isOpenAssign']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closeModals()
    {
        $this->isOpen = false;
        $this->isOpenAssign = false;
        $this->showUser = false;
        $this->isOpenDelete = false;
    }

    public function select($type, $value)
    {
        if ($type === 'userState') {
            $this->userState = $value;
        } elseif ($type === 'userRol') {
            $this->userRol = $value;
        }
    }

    private function resetForm()
    {
        $this->form->reset();
        $this->reset(['user', 'itemId']);
        $this->resetValidation();
    }
}
