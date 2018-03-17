<?php

namespace Muhzar\Zmember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Redirect;
use Validator;
use Socialite;
use Log;
use Muhzar\Zmember\models\MemberLogin;
use Muhzar\Zmember\models\Member;
use Muhzar\Zmember\models\LoginChannel;
use Muhzar\Zmember\ZmemberWrapper;

class ZauthController extends Controller
{

    public function showLogin()
    {
        return view('zmember::login');
    }

    static function isLogin()
    {
    	if (session()->has('isLogin') && session('isLogin')) {
    		return true;
    	}

    	return false;
    }

    public function doLogin(Request $request)
    {
        
        $validateInput = [
                            'email' => 'required|email',
                            'password' => 'required|min:6',
                         ];

        $customError =  [
                            'exists' => 'You are not registered yet'
                        ];

        $this->validate($request, $validateInput, $customError);

        $auth = MemberLogin::where('email', $request->input('email'))
                            ->where('channel_id', 0)
                            ->where('status', 1)
                            ->first();

        if ($auth) {
            if (Hash::check($request->input('password'), $auth->password)) {
                $user = Member::where('email', $request->input('email'))->first();
                self::setSession($user);
                if ($request->input('url-redirect') != '') { 
                    return Redirect::to($request->input('url-redirect')); 
                }

                return Redirect::to(config('zmember.url_after_login'));
            } else {
                return redirect()->back()->with('error', 'Invalid Email or Password');
            }
        } else {
            return redirect()->back()->with('error', 'The email address that you\'ve entered doesn\'t match any account.');
        }
        

    }

    public function socialLogin($channel)
    {
        return Socialite::driver($channel)->scopes(['email'])->redirect();
    }

    public function socialCallback(Request $request , $channel)
    {
        try {
            $user = Socialite::driver($channel)->user();
            $this->saveMemberViaSocial($user, 'facebook');
            if (session()->has('intended-page')) {
                return Redirect::to(session('intended-page'));
            }

            return Redirect::to(config('zmember.url_after_login'));
        } 
        catch (\Exception $e) {
            Log::info('==== log-trace Socialite: ' . $e);
            return Redirect::to ('/');
        }

    }

    public function saveMemberViaSocial($userSocial, $channel)
    {
        $user = Member::where('email', $userSocial->email)->first();
        if (!$user) {
            $user = Member::create([
                                        'email' => $userSocial->email,
                                        'name' => $userSocial->name,
                                    ]);
        }
        $loginChannel = LoginChannel::SearchByName($channel)->first();
        MemberLogin::updateOrCreate([
                                        'email' => $userSocial->email,
                                        'channel_id' => $loginChannel->id
                                    ],[
                                        'attributes' => json_encode($userSocial)
                                    ]);

        if (!self::isLogin()){
            self::setSession($user);
        }
    }

    static public function auth() {
        if (self::isLogin()) {
            return new ZmemberWrapper(session('user'));
        } else {
            return null;
        }
    }

    static public function setSession($user)
    {
        session([
                    'isLogin' => true,
                    'user.name' => $user->name,
                    'user.email' => $user->email,
                ]);
    }


}
