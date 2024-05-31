<?php

namespace App\Http\Controllers;

use App\Models\Account;

use App\Mail\PasswordMailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Retrieve the user by email
        $user = Account::where('email', $request->email)->first();
    
        if (!$user) {
            return redirect()->back()->withErrors(['email' => __('User not found.')])->withInput();
        }
    
        // Generate the password reset link
        $token = Password::createToken($user);
        $resetLink = url(route('passwords.reset', ['token' => $token, 'email' => $request->email], false));
    
        // Send the custom password reset email
        Mail::to($user->email)->send(new PasswordMailer($user->username, $resetLink));
    
        return redirect()->back()->with('status', __('Password reset link sent. Check your email.'));
    }
}
