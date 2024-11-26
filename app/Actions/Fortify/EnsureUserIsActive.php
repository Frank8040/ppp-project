<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use App\Actions\Fortify\InactiveUserResponse;
use App\Models\User;

class EnsureUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, $next)
    {
        $credentials = $request->only('email');
        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->status !== 1) {
            return app(InactiveUserResponse::class)->toResponse($request);
        }

        return $next($request);
    }
}
