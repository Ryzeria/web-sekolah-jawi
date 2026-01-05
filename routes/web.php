<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\FiturController;
use App\Http\Controllers\AlasanController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\FiturPaketController;
use App\Http\Controllers\HistoryBillingController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegistrationController;
use App\Models\Slider;
use Illuminate\Support\Facades\Artisan;

Route::middleware('web')->group(function () {

    Route::get('/paket', function () {
        return view('landing-page.paketselect');
    })->name('infopaket');

    Route::get('/clear-cache', function () {
        Artisan::call('config:clear');
        return "Config cache cleared!";
    });

    // Attempt to create the link
    Route::get('/create-link', function () {
        if (file_exists(public_path('storage'))) {
            return 'The "storage" link already exists.';
        }
        try {
            Artisan::call('storage:link');
            return 'The "storage" link has been connected.';
        } catch (Exception $e) {
            return 'Error creating link: ' . $e->getMessage();
        }
    });

    Route::get('/', [LandingPageController::class, 'index']);

    Route::resource('/register', RegistrationController::class)->only(['index', 'store'])->names('register');
    Route::get('/register/confirm', [RegistrationController::class, 'confirm'])->name('register.confirm');
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'store'])->middleware('guest');
    Route::get('forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request')->middleware('guest');
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('guest');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset')->middleware('guest');
    Route::post('reset-password', [PasswordResetController::class, 'reset'])->name('password.update')->middleware('guest');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout'); // Add logout route

    // Payment/License Activation Routes
    Route::prefix('payment')->name('payment.')->group(function () {
        // Show package selection form
        Route::get('/paket', [PaymentController::class, 'showPackageSelection'])->name('packages');

        // Process package selection
        Route::post('/paket', [PaymentController::class, 'processPackageSelection']);

        // Show payment method selection
        Route::get('/payment-methods', [PaymentController::class, 'showPaymentMethods'])->name('payment-methods');

        // Process payment method selection
        Route::post('/payment-methods', [PaymentController::class, 'processPaymentMethodSelection'])->name('process-payment-method');

        // Show payment confirmation
        Route::get('/confirmation', [PaymentController::class, 'showConfirmation'])->name('confirmation');

        // Process final payment
        Route::post('/confirmation', [PaymentController::class, 'processPayment']);

        // Payment success page
        Route::get('/success', [PaymentController::class, 'showSuccess'])->name('success');

        // API endpoint for package details (AJAX)
        Route::get('/package-details', [PaymentController::class, 'getPackageDetails'])->name('package.details');
    });

    // --- Protected Routes ---
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
        // The 'prefix('admin')' removes the need to write '/admin' in every URL

        Route::get('/dashboard', function () {
            return view('adminpage.dashboard');
        })->name('dashboard');

        Route::resource('/slider', sliderController::class)->names('sliders');
        Route::resource('/fitur', fiturController::class)->names('fitur');
        Route::resource('/alasan', alasanController::class)->names('alasan');
        Route::resource('/testimoni', testimoniController::class)->names('testimoni');
        Route::resource('/paket', paketController::class)->names('paket');
        Route::resource('/fitur-paket', FiturPaketController::class)->names('fitur_paket');
        Route::resource('/billing', billingController::class)->names('billing');
        Route::resource('/history-billing', historyBillingController::class)->names('history_billing');
    });
});
