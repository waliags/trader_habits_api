<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/reset-password', function () {
    return view('auth.reset-password'); // You will create this view next
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->save();

            // optional: revoke tokens or notify user
        }
    );

    return $status == Password::PASSWORD_RESET
        ? redirect('/reset-password')->with('status', 'Password reset successfully.')
        : back()->withErrors(['email' => [__($status)]]);
});