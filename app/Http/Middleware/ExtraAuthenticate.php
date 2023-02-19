<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\Models\User;

class ExtraAuthenticate
{
    public function handle($request, Closure $closure)
    {
        if($request->user() == null) {
            Auth::logout();
            return redirect(route("login"));
        }

        $currentAvailableRoutes = $request->user()->is_admin ? $this->adminRoutes : $this->userRoutes;

        if(!in_array($request->route()->getName(), $currentAvailableRoutes)) {
            return redirect(route("dashboard"));
        };

        return $closure($request);
    }

    public $adminRoutes = [
        'logout.post',
        'dashboard',
        'users.users',
        'users.create',
        'users.create.post',
        'users.update',
        'users.update.post',
        'tours.tours',
        'tours.create',
        'tours.create.post',
        'tours.update',
        'tours.update.post',
        'tours.delete.post',
    ];

    public $userRoutes = [
        'logout.post',
        'dashboard',
        'users.update',
        'users.update.post',
        'tours.userView'
    ];
}
