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
        //return $next($request);
        $params = explode('/', $request->path());
        $currentrole = session('currentrole', false);
        $userRoles = Auth::user()->roles->pluck('id')->toArray();

        if (count($params) > 1 && in_array($params[1], $userRoles)) {
            session(['currentrole' => $params[1]]);

            return $next($request);
        }

        if ($currentrole && in_array($currentrole, $userRoles)) {
            app('session')->reflash();
            $allSegments = $request->segments();

            $updatedSegments = array_merge(array_slice($allSegments, 0, 1),
                array(1 => $currentrole), 
                array_slice($allSegments, 1, count($allSegments) - 1)) ;

            $redirection = $request->root() . "/" . implode('/', $updatedSegments);

            return new RedirectResponse($redirection, 302, []);
        }

        return $next($request);
    }
}
