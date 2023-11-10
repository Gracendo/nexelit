<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminSettingsPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$param)
    {
        if (Auth::guard('admin')->check()) {
            $user_role = \App\AdminRole::where('id', auth()->guard('admin')->user()->role)->first();
            $all_permission = json_decode($user_role->permission);
            if (in_array(strtolower(str_replace(' ','_',$param)), $all_permission)) {
                return $next($request);
            }
        }
        return redirect()->route('admin.home');
    }
}
