<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;


class Demo
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
       $not_allow_path = [
          'admin-home',
          'user-home'
        ];
        
        $allow_path = [
            'admin-home/visited/os',
            'admin-home/visited/browser',
            'admin-home/visited/device',
            'admin-home/visited-url',
            'admin-home/media-upload/all',
            'admin-home/media-upload/loadmore'
            ];
            
        $contains = Str::contains($request->path(), $not_allow_path);
        
        if($request->isMethod('POST') || $request->isMethod('PUT')) {
            
            if($contains && !in_array($request->path(),$allow_path)){
                if ($request->ajax()){
                    return response()->json(['type' => 'warning' , 'msg' => 'This is demonstration purpose only, you may not able to change few settings, once your purchase this script you will get access to all settings.']);
                }
                return redirect()->back()->with(['type' => 'warning' , 'msg' => 'This is demonstration purpose only, you may not able to change few settings, once your purchase this script you will get access to all settings.']);
            }
            
        }
        
        return $next($request);
    }
}
