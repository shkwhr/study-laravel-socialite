<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Socialite;
use App\User;

class AuthController extends Controller
{
    public function redirectToProvider($provider) {
      return Socialite::driver($provider)->redirect();
      // return Socialite::with('salesforce')->redirect();
    }

    // Social認証後の処理
    public function   handleProviderCallback($provider) {
      // provider ユーザー情報取得
      $user = Socialite::driver($provider)->user();
      // 新規or既存ユーザー判定
      $authUser = $this->findOrCreateUser($user, $provider);
      Auth::login($authUser, true);   // Authにソーシャル情報を預けてログイン
      return redirect('/');       // 認証後に表示したいページ
    }

    // 新規or既存ユーザー判定
    public function findOrCreateUser($user, $provider) {

      $authuser = User::where('provider_id', $user->id)->first();
      if ($authuser) {
        // 既存ユーザー情報返却
        return $authuser;
      }
      // 新規ユーザー登録 & 返却
      return User::create([
         'name'            => $user->name
        ,'email'           => $user->email
        ,'organization_id' => $user->user['organization_id']
        ,'provider'        => $provider
        ,'provider_id'     => $user->id
      ]);
    }
}
