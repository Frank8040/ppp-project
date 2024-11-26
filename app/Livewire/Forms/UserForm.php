<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class UserForm extends Form
{
    public $id;
    public $dni;
    public $name;
    public $surnames;
    public $phone;
    public $email;
    public $status;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'dni' => 'required|string|min:8|max:8|unique:users,dni' . ($this->id ? ',' . $this->id : ''),
            'name' => 'required|min:3',
            'surnames' => 'required|min:3',
            'phone' => 'required|min:11',
            'email' => 'required|email|max:255|unique:users,email' . ($this->id ? ',' . $this->id : ''),
            'status' => 'required',
            'password' => ($this->id ? 'nullable' : 'required|min:8') ,
            'password_confirmation' => ($this->id ? 'nullable' : 'required|min:8|same:password'),
        ];
    }
}
