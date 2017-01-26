<?php
namespace App\Http\Middleware;

use App\Role;
use Closure;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isUserAdmin = auth()->user()->isAdmin();

        if (auth()->check() && $isUserAdmin) {
            return $next($request);
        }
        return abort(401, 'Unauthorized');
    }
}