<?php

namespace App\Http\Middleware;

use Closure;

class InstitutionRepresentative
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
        $user = \Auth::user();
        
        
        if ($user->hasRole('college') && $user->institutions) {
            
            $routeName = url()->current();
            
            $institutions = $user->institutions;
            
            foreach ($institutions as $institution) {
                $representative = str_contains($routeName, $institution->slug);
                
                if ($representative) {
                    break;
                }
            }
            
            if ($representative) {
                return $next($request);
            }
            
            $institution1 = $user->institutions[0];
            return redirect()->route('institutions.show', [$institution1->type, $institution1]);
        }
        
        return $next($request);
    }
}
