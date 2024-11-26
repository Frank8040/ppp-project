<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surnames' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string', 'max:8'],
            'code' => ['required', 'string', 'max:9'],
            'phone' => ['required', 'string', 'max:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Crear el usuario
        $user = User::create([
            'name' => $input['name'],
            'surnames' => $input['surnames'],
            'email' => $input['email'],
            'dni' => $input['dni'],
            'phone' => $input['phone'],
            'code' => $input['code'],
            'password' => Hash::make($input['password']),
        ]);

        // Asignar el rol
        $user->assignRole('Usuario');

        return $user;
    }
}
