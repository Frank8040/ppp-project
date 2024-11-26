<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as FailedLoginResponseContract;
use Illuminate\Http\JsonResponse;

class InactiveUserResponse implements FailedLoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $message = 'Su cuenta está inactiva. Por favor, contacte al administrador.';

        if ($request->expectsJson()) {
            return new JsonResponse(['message' => $message], 422);
        }

        return back()->withErrors([
            'email' => $message,
        ]);
    }
}
