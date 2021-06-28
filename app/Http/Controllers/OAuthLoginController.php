<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Socialite;
use Auth;

class OAuthLoginController extends Controller
{
    //
    // Googleの認証ページへのリダイレクト処理
    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect('');
    }

    // Googleの認証情報からユーザー情報の取得
    public function authGoogleCallback()
    {
      $gUser = Socialite::driver('google')->stateless()->user();
      // email が合致するユーザーを取得
      $user = User::where('email', $gUser->email)->first();
      // 見つからなければ新しくユーザーを作成
      if ($user == null) {
          $user = $this->createUserByGoogle($gUser);
      }
      // ログイン処理
      \Auth::login($user, true);
      return redirect('/users');
    }

    public function createUserByGoogle($gUser)
    {
        $user = User::create([
            'name'     => $gUser->name,
            'email'    => $gUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }

}