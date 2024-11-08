<?php

namespace App\Http\Controllers;

use App\Exceptions\LinkExpiredException;

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
    
        if ($user->verified) {
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
            throw new LinkExpiredException("The link has expired.", 403);
        }

        $user = Account::findOrFail($id);

        if (! hash_equals((string) $hash, sha1($user->email))) {
            throw new LinkExpiredException("Invalid verification link.", 403);
        }

        if ($user->verified) {
            return redirect('/');
        }

        $user->update(['verified' => true]);

        $user->markEmailAsVerified();
        event(new Verified($user));

        return redirect('/user/settings')->with('success', 'Your email address has been verified.');;
    }
}
