<?php namespace SleepingOwl\Admin\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class Language implements Middleware {
    public function handle($request, Closure $next)
    {
        if (\Config::get('admin.language_switcher') && \Session::has('applocale') && array_key_exists(\Session::get('applocale'), \Config::get('admin.languages'))) {
            \App::setLocale(\Session::get('applocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            \App::setLocale(\Config::get('app.fallback_locale'));
        }
        
        return $next($request);
    }
}