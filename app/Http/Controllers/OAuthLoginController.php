<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Socialite;
use Auth;
use Exception;

class OAuthLoginController extends Controller
{
    //
    use AuthenticatesUsers;

    public function redirectPath()
    {
        return '/users';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Googleの認証ページへのリダイレクト処理
    public function getGoogleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    // Googleの認証情報からユーザー情報の取得
    public function authGoogleCallback()
    {    
      $user = Socialite::driver('google')->stateless()->user();

      $finduser = User::where('google_id', $user->id)->first();

      if($finduser){

          Auth::login($finduser);

          return redirect('/users');

      }else{
          $newUser = User::create([
              'name' => $user->name,
              'email' => $user->email,
              'google_id'=> $user->id,
              'password' => encrypt('Superman_test')
          ]);

          Auth::login($newUser);

          return redirect('/users');
      }
  }
}