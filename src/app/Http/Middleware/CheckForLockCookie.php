<?php

namespace App\Http\Middleware;

use Closure;

class CheckForLockCookie
{
    /**
     * Route URIs to which the middleware does not apply
     *
     * @var array
     */
    protected $except = [
        'access',
        'access/clear',
        'front/stores/ad',
        'front/stores',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentUrl = $request->url();

        if ($request->wantsJson()) {
            return $next($request);
        }

        foreach ($this->except as $url) {
            if (str_contains($currentUrl, $url)) {
                return $next($request);
            }
        }

        $locked = config('auth.lock.status');

        if (! $locked) {
            return $next($request);
        }

        $isAllowed = $request->session()->has('allow-access') ? $request->session()->get('allow-access') : false;

        if (! $isAllowed) {
            return redirect()->route('access.show');
        }

        return $next($request);
    }
}
