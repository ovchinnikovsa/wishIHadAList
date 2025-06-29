<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthCred;
use App\Models\Enums\AuthCredTypeEnum;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirect(): \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            /** @var \Laravel\Socialite\Two\User $googleUser */
            $googleUser = Socialite::driver('google')->user();

//            DB::beginTransaction();
            $authCred = AuthCred::firstOrCreate([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'foreign_id' => $googleUser->id,
                'token' => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken,
                'type_id' => AuthCredTypeEnum::GOOGLE,
                'expires_in' => $googleUser->expiresIn,
            ]);

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => Hash::make(uniqid()), // todo: отправлять письмо на почту с ссылкой для смены пароля мб чтобы не было проблем с паролем
                    'auth_cred_id' => $authCred->id,
                ]
            );
//            DB::commit();

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Ошибка аутентификации через Google');
        }
    }
}
