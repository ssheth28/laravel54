<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\RedirectResponse;

class RoleSessionRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $params = explode('/', $request->path());
        $currentrole = session('currentrole', false);
        $userRoles = Auth::user()->roles->pluck('id')->toArray();

        if (count($params) > 1 && in_array($params[1], $userRoles)) {
            session(['currentrole' => $params[1]]);

            return $next($request);
        }

        if ($currentrole && in_array($userRoles, $currentrole)) {
            app('session')->reflash();
            $redirection = app('laravellocalization')->getLocalizedURL($locale);

            return new RedirectResponse($redirection, 302, []);
        }

        return $next($request);
    }
}
