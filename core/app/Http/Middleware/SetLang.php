<?php

namespace App\Http\Middleware;

use App\Language;
use Closure;
use Illuminate\Http\Request;

class SetLang
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
        if (session()->has('lang')) {
            app()->setLocale(session()->get('lang').'_'.$location);
        } else {

            try {
                $defaultLang =  Language::where('default',1)->first();
            }catch (\Exception $e){
                return null;
            }

            if (!empty($defaultLang)) {
                app()->setLocale($defaultLang->slug.'_'.$location);
            }
        }
        return $next($request);
    }
}
