<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;

use App\Mail\VerifyEmail;

use App\Models\Account;

class MailerController extends Controller
{
    public function resend(Request $request)
    {
        $user = $request->user();
    
        if ($user->hasVerifiedEmail()) {
            return Redirect::route('user.settings')->with('success', 'Your email address is already verified.');
        }
    
        // Generate a signed URL for email verification
        $verificationUrl = URL::temporarySignedRoute(
            'mail.verify', now()->addMinutes(20), ['id' => $user->id, 'hash' => sha1($user->email)]
        );
    
        // Send the verification email
        Mail::to($user->email)->send(new VerifyEmail($user->username, $verificationUrl));
    
        return back()->with('resent', true);
    }

    public function verify(Request $request, $id, $hash)
    {
        if (! URL::hasValidSignature($request)) {
            abort(403);
        }

        $user = Account::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->email))) {
            abort(403);
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/');
        }

        $user->update(['verified' => true]);

        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect('/user/settings')->with('success', 'Your email address has been verified.');;
    }
}
