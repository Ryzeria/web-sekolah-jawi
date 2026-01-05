<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('landing-page.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data from the form
        $request->validate([
            'id_sekolah' => 'required|string',
            'email'      => 'required|string|email',
            'password'   => 'required|string',
        ]);

        // 2. Prepare the credentials for authentication.
        //    The array keys MUST match your database column names.
        $credentials = [
            'id_sekolah'    => $request->id_sekolah,
            'email_sekolah' => $request->email, // Manually map form 'email' to DB 'email_sekolah'
            'password'      => $request->password,
        ];

        // 3. Attempt to authenticate the user
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // If successful, regenerate the session to prevent session fixation
            $request->session()->regenerate();

            // Redirect the user to their intended destination or the dashboard
            return redirect()->intended('/admin/dashboard');
        }

        // 4. If authentication fails, redirect back with an error message
        //    This attaches the error to the 'id_sekolah' field for better UX.
        throw ValidationException::withMessages([
            'id_sekolah' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
