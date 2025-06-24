<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class VkController extends Controller
{
    public function redirect(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback()
    {
        try {
            $vkUser = Socialite::driver('vkontakte')->user();

            $user = User::firstOrCreate(
                ['email' => $vkUser->getEmail()],
                [
                    'name' => $vkUser->getName(),
                    'password' => Hash::make(uniqid()),
                    'vk_id' => $vkUser->getId(),
                ]
            );

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Ошибка аутентификации через Vkontakte');
        }
    }
}
