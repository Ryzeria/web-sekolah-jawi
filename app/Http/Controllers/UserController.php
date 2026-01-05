<?php

namespace App\Http\Controllers;

use App\Models\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('landing-page.registration');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'nama_sekolah'  => 'required|string|max:100',
            'alamat'        => 'required|string',
            'nomor_telepon' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/'], // Basic validation for Indonesian numbers
            'email'         => 'required|string|email|max:100|unique:users,email_sekolah',
            'password'      => ['required', 'string', Password::min(8)->mixedCase()->numbers()],
        ]);

        // 2. Prepare data for user creation
        $userData = [
            'id_sekolah'    => $this->generateUniqueSekolahId(),
            'nama_sekolah'  => $validatedData['nama_sekolah'],
            'email_sekolah' => $validatedData['email'], // Maps 'email' from form to 'email_sekolah'
            'alamat'        => $validatedData['alamat'],
            'nomor_telepon' => $this->formatPhoneNumber($validatedData['nomor_telepon']),
            'password'      => $validatedData['password'], // The User model will hash this automatically
            'role'          => UserRole::ADMIN, // Explicitly set the role for clarity
        ];

        // 3. Create the user in the database
        User::create($userData);

        // 4. Redirect to the login page with a success message
        // Make sure you have a route named 'login'
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }

    /**
     * Generates a unique school ID in the format 'ID' + 8 random digits.
     *
     * @return string
     */
    private function generateUniqueSekolahId(): string
    {
        do {
            // Generate a random 8-digit number, padding with leading zeros if necessary
            $randomNumber = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            $id = 'ID' . $randomNumber;
        } while (User::where('id_sekolah', $id)->exists()); // Loop until a unique ID is found

        return $id;
    }

    /**
     * Formats a local phone number (e.g., 0812...) to international format (+62812...).
     *
     * @param string $phoneNumber
     * @return string
     */
    private function formatPhoneNumber(string $phoneNumber): string
    {
        // Check if the number starts with '0'
        if (Str::startsWith($phoneNumber, '0')) {
            // Replace the leading '0' with '+62'
            return '+62' . substr($phoneNumber, 1);
        }

        // Return the number as-is if it doesn't start with '0'
        return $phoneNumber;
    }
}
