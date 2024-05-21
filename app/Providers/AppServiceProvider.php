<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Auth;
use App\Models\Character;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.app', function ($view) {
            $user = Auth::user();
            $uid = Auth::id();

            $username = null;
            $adminStatus = 0;

            if ($user) {
                $username = $user->username;
                $character = new Character();
                $adminStatus = $character->isUserAdmin($uid);
            }

            $view->with('username', $username);
            $view->with('adminStatus', $adminStatus);
        });

        View::composer('layouts.navbar', function ($view) {
            $user = Auth::user();
            $uid = Auth::id();

            $username = null;
            $adminStatus = 0;

            if ($user) {
                $username = $user->username;
                $character = new Character();
                $adminStatus = $character->isUserAdmin($uid);
            }

            $view->with('username', $username);
            $view->with('adminStatus', $adminStatus);
        });
    }
}
