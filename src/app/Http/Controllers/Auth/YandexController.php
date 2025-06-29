<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthCred;
use App\Models\Enums\AuthCredTypeEnum;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
            /** @var \Laravel\Socialite\Two\User $yandexUser */
            $yandexUser = Socialite::driver('yandex')->user();

            DB::beginTransaction();
            $authCred = AuthCred::firstOrCreate([
                'name' => $yandexUser->name,
                'email' => $yandexUser->email,
                'foreign_id' => $yandexUser->id,
                'token' => $yandexUser->token,
                'refresh_token' => $yandexUser->refreshToken,
                'type_id' => AuthCredTypeEnum::YANDEX,
                'expires_in' => $yandexUser->expiresIn,
            ]);

            $user = User::firstOrCreate(
                ['email' => $yandexUser->getEmail()],
                [
                    'name' => $yandexUser->getName(),
                    'password' => Hash::make(uniqid()), // todo: отправлять письмо на почту с ссылкой для смены пароля мб чтобы не было проблем с паролем
                    'auth_cred_id' => $authCred->id,
                ]
            );
            DB::commit();

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Ошибка аутентификации через Yandex');
        }
    }
}
