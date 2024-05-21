<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;
use App\Models\Character;

class AdminMiddleware
{
    protected $character;

    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $this->character->isUserAdmin($user->id) > 0) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You do not have access to this page.');
    }
}
