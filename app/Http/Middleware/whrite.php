<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class whrite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userGroups =$request->user()->userGroup();
        $hasAcces=true;
        foreach ($userGroups as $userGroup) {
            $permissions=$userGroup->permissions();
            foreach ($permissions as $permission) {
                $accesses =$permission->access();
                foreach ($accesses as $access) {
                    if($access->whrite){
                        return $next($request);
                    }
                }
            }
        }
        return abort(403, 'Vous n\'avez pas la permission nécessaire pour cette operation');
    }
}
