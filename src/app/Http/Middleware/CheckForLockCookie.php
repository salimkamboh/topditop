<?php

namespace App\Http\Middleware;

use Closure;

class CheckForLockCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locked = config('auth.lock.status');

        if (! $locked) {
            return $next($request);
        }

        $isAllowed = $request->hasCookie('allow-access');

        if (! $isAllowed) {
            return redirect()->route('access.show');
        }

        return $next($request);
    }
}
