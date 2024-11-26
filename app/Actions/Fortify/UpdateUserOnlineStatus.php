<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateUserOnlineStatus
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

        if ($user) {
            $user->update(['online' => 1]);
        }

        return $next($request);
    }
}
