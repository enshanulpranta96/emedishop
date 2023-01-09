<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //redirect to admin home
                if ($guard === 'admin') {
                    return redirect()->route('admin.home');
                }
                //redirect to vendor home
                if ($guard === 'vendor') {
                    return redirect()->route('vendor.home');
                }

                // if ($guard === 'vendor') {
                //     if (Auth::guard('vendor')->user()->acc_status != 'new') {
                //         Auth::guard('vendor')->logout();
                //         return redirect()->route('vendor.login');
                //     } else {
                //         return redirect()->route('vendor.home');
                //     }
                // }

                //redirect to user home
                return redirect('/');
            }
        }

        return $next($request);
    }
}
