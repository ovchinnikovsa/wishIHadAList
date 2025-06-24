<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class YandexController extends Controller
{
    public function redirect(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('yandex')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('yandex')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => Hash::make(uniqid()),
                    'yandex_id' => $googleUser->getId(),
                ]
            );

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Ошибка аутентификации через Yandex');
        }
    }
}
