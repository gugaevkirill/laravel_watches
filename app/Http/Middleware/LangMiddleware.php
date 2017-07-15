<?php

namespace App\Http\Middleware;

use App\Repositories\LangRepository;
use Closure;
use Illuminate\Support\Facades\Redirect;

class LangMiddleware
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
        // Ничего не делаем для админки
        if (preg_match('/admin.*/i', $request->path())) {
            return $next($request);
        }

        $repository = new LangRepository($request);

        // Если перешли на сабдомен дефолтной локали, редиректим
        if ($repository->isRedirectRequired()) {
            return Redirect::away($repository->getRedirectUrl());
        };

        // Выставляем локаль в зависимости от поддомена
        if ($repository->isValidSubdomain()) {
            \App::setLocale($repository->getSubdomain());
        }

        return $next($request);
    }
}
