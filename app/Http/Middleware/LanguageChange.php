<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use App\Language;
use Auth;

class LanguageChange
{
    //private $language_id;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //dd($request->user());
        $app_locale = Config::get('app.locale');
        if(Auth::check()){
            $lang = Language::find($request->user()->language_id);
            if (strtolower($app_locale) != strtolower($lang->slug)) //app_locale geralmente em minuscula e lang->slug normalmente em maiuscula
            {
                Config::set('app.fallback_locale', $app_locale);
                app()->setLocale($lang->slug);
            }

            //$this->language_id = $lang->id;
        } else {
            app()->setLocale(Config::get('app.fallback_locale'));
            //$this->language_id = null;
        }

        //$request->attributes->add(['language_id' => $this->language_id]);

        return $next($request);
    }
}
