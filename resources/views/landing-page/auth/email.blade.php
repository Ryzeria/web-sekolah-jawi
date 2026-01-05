<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Forgot Password</title>

    <style>
        body {
            /* --- MULTIPLE BACKGROUND IMAGES --- */
            /* The first image is the top layer, the second is the bottom layer. */
            background-image: url("{{ asset('assets/images/Frame-1.png') }}"),
                url("{{ asset('assets/images/Background-1.png') }}");

            /* --- SIZING FOR EACH LAYER --- */
            /* The first value applies to the first image, the second to the second, etc. */
            background-size: cover, cover;

            /* --- Other properties for each layer --- */
            background-position: center, center;
            background-repeat: no-repeat, no-repeat;
            background-attachment: fixed, fixed;
            /* Both backgrounds will be fixed */
        }
    </style>
</head>

<body>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white/30 backdrop-blur-lg rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                    Forgot Your Password?
                </h1>
                <p class="text-sm font-light text-gray-500">
                    No problem. Just let us know your email address and we will email you a password reset link.
                </p>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5"
                            placeholder="name@company.com" required autofocus>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Email Password Reset Link
                    </button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:underline">
                            Back to login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
