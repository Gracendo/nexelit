<?php

namespace App\Http\Middleware;

use App\Language;
use Closure;
use Carbon\Carbon;

class SetUserLanguages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$location)
    {

        $defaultLang =  Language::where('default',1)->first();
        if (session()->has('lang')) {
            $current_lang = Language::where('slug',session()->get('lang'))->first();
            if (!empty($current_lang)){
                app()->setLocale($current_lang->slug.'_'.$location);
                Carbon::setLocale($current_lang->slug);
            }else {
                session()->forget('lang');
            }
        }else{
            Carbon::setLocale($defaultLang->slug);
            app()->setLocale($defaultLang->slug.'_'.$location);
        }
        
        return $next($request);
    }
}
