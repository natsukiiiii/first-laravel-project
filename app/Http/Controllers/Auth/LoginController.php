<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use Auth;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // twitterの認証ページへユーザーをリダイレクト
    public function redirectToProvider(){
        // dd('test');
        return Socialite::driver('twitter')->redirect();
    }

    // twitterからユーザー情報を取得
    public function handleProviderCallback()
    {  
        // dd('test');
        try {  
            // dd('test');
            $user = Socialite::driver('twitter')->user();
            // dd($user);
                
            $socialUser = User::firstOrCreate([
                'token'    => $user->token,
            ], [
                'token'    => $user->token,
                'name'     => $user->name,
                'email'    => $user->email,
                // 'avatar'   => $user->avatar_original,
            ]);
            Auth::login($socialUser, true);
        } catch (Exception $e) {
            return redirect()->route('login');
        }
        
        return redirect()->route('posts.index');


    }
}
