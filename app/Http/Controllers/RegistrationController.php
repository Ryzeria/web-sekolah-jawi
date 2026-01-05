<?php

namespace App\Http\Controllers;

use App\Models\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegistrationController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('landing-page.registration');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $data = $request->validate([
            'nama_sekolah'  => 'required|string|max:100',
            'alamat'        => 'required|string',
            'nomor_telepon' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/'], // Basic validation
            'email'         => 'required|string|email|max:100|unique:users,email_sekolah',
            'password'      => ['required', 'string', Password::min(8)->mixedCase()->numbers()],
        ]);

        // Prepare data for user creation
        $userData = [
            'id_sekolah'    => $this->generateUniqueSekolahId(),
            'nama_sekolah'  => $data['nama_sekolah'],
            'email_sekolah' => $data['email'], // Maps 'email' from form to 'email_sekolah'
            'alamat'        => $data['alamat'],
            'nomor_telepon' => $this->formatPhoneNumber($data['nomor_telepon']),
            'password'      => $data['password'], // The User model will hash this automatically
            'role'          => UserRole::ADMIN, // Explicitly set the role for clarity
        ];

        // Create the user in the database
        $user = User::create($userData);

        // This data will only persist for the next request.
        session()->flash('newly_registered_user_id', $user->id);

        // Redirect to the confirmation route without exposing any ID in the URL.
        return redirect()->route('register.confirm');
    }

    /**
     * Display the registration confirmation page using data from the session.
     */
    public function confirm()
    {
        // Retrieve the user's ID from the session.
        $userId = session('newly_registered_user_id');

        // If there's no ID in the session, the user didn't just register.
        // Redirect them away to prevent direct URL access.
        if (!$userId) {
            return redirect()->route('register.index');
        }

        // Find the user by their unique primary key.
        $user = User::findOrFail($userId);

        // Generate the unique school link.
        $user->link_sekolah = 'https://linksekolah.co/id/' . $user->id_sekolah;

        return view('landing-page.confirm', ['user' => $user]);
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
        } while (User::where('id_sekolah', $id)->exists()); // Loop until a unique ID

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
