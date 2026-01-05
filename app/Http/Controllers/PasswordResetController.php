<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('landing-page.auth.email');
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function sendResetLinkEmail(Request $request)
    {
        //    Validate the input from the form, which is named 'email'.
        $request->validate(['email' => 'required|email']);

        //    Prepare credentials for the password broker.
        //    THIS IS THE KEY FIX: We map the form's 'email' field to the database's 'email_sekolah' column.
        $credentials = ['email_sekolah' => $request->email];

        //    The Password facade will now correctly query:
        //    SELECT * FROM users WHERE email_sekolah = '...'
        $status = Password::sendResetLink($credentials);

        return $status == Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    // public function sendResetLinkEmail(Request $request)
    // {
    //     //    Validate the input from the form.
    //     $request->validate(['email' => 'required|email']);

    //     //    Find the user manually by their 'email_sekolah'.
    //     $user = User::where('email_sekolah', $request->email)->first();

    //     //    If no user is found, redirect back with an error message.
    //     if (! $user) {
    //         return back()->withErrors(['email' => __("We can't find a user with that email address.")]);
    //     }

    //     //    Create a password reset token for the found user.
    //     $token = Password::createToken($user);

    //     //    Build the password reset URL using the named route.
    //     $resetUrl = route('password.reset', [
    //         'token' => $token,
    //         'email' => $user->getEmailForPasswordReset(), // This correctly gets the email_sekolah
    //     ]);

    //     //    Dump the URL and stop execution. You can now copy and paste this link.
    //     //    For security, REMOVE THIS and restore the original code before production!
    //     dd($resetUrl);
    // }

    /**
     * Display the password reset view for the given token.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('landing-page.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Handle an incoming new password request.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // THIS IS THE SECOND KEY FIX: We apply the same logic for the actual reset.
        // We create a credentials array that maps the form's 'email' input
        // to the database's 'email_sekolah' column.
        $credentials = [
            'email_sekolah' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'token' => $request->token,
        ];

        // The broker will use 'email_sekolah' to find the user before resetting the password.
        $status = Password::broker()->reset(
            $credentials,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
