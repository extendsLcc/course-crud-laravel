<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\LoginInputData;
use Illuminate\Validation\ValidationException;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;

class AuthController extends Controller
{
    #[Get('login', name: 'auth.show')]
    public function show()
    {
        return hybridly('auth.login-page');
    }

    #[Post('login', name: 'auth.login')]
    public function login(LoginInputData $loginData)
    {
        if (auth()->attempt($loginData->toArray())) {
            request()->session()->regenerate();

            return redirect()->intended('home');
        }

        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    #[Post('logout', name: 'auth.logout')]
    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.show');
    }
}
