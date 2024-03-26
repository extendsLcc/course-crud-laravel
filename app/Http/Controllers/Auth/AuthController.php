<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Data\LoginInputData;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class AuthController extends Controller
{
    #[Get('login', name: 'auth.show', middleware: 'guest')]
    public function show()
    {
        return hybridly('auth.login-page');
    }

    #[Post('login', name: 'auth.login', middleware: 'throttle')]
    public function login(LoginInputData $loginData)
    {
        if (auth()->attempt($loginData->toArray())) {
            request()->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    #[Post('logout', name: 'auth.logout', middleware: 'auth')]
    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.show');
    }
}
