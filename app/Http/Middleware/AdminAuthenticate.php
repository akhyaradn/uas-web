<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

class AdminAuthenticate
{
    public function handle($request, Closure $closure)
    {
        if(!$request->user()->is_active) {
            return redirect(route("dashboard"));
        }

        return $closure($request);
    }
}
