<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    protected function credentials(Request $request)
    {
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return [
            $field => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);

        $user = Account::where('username', $credentials['username'])
            ->orWhere('email', $credentials['username'])
            ->first();

        if ($user) {
            // Check SHA-256 hashed password

            if(!empty($user->key)) {
                $storedHash = $user->key;
                $storedSalt = $user->salt;
        
                // Hash the provided password with the stored salt
                $hashedPassword = hash('sha256', $credentials['password'] . $storedSalt);

                $storedHash = strtolower($storedHash);

                //Log::info($storedHash);
                //Log::info($storedSalt);
                //Log::info($hashedPassword);
        
                if ($hashedPassword === $storedHash) {
                    // Update to bcrypt
                    $user->password = Hash::make($credentials['password']);
                    $user->key = null;
                    $user->salt = null;
                    $user->save();

                    // Authenticate user
                    Auth::login($user);

                    //Log::info('SHA-256 password verified');
                    return true;
                }
            }
            else 
            {
                // Check bcrypt hashed password
                if (Hash::check($credentials['password'], $user->password)) {
                    return Auth::attempt($credentials, $request->filled('remember'));
                }
            }
        }

        return false;
    }

    public function username()
    {
        $login_type = filter_var(request()->input('email'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';
    
        request()->merge([
            $login_type => request()->input('email')
        ]);
    
        return $login_type;
    }
}
