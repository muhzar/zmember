<?php

namespace Muhzar\Zmember;

use Illuminate\Http\Request;
use Hash;
use Redirect;
use Validator;
use App\Http\Controllers\Controller;
use Zarkasih\Zmember\Zauth;
use Zarkasih\Zmember\models\Member;
use Zarkasih\Zmember\models\MemberLogin;

class ZregisterController extends Controller
{
	private $needVerifiedEmail = false;

    public function showRegister()
    {
    	return view('zmember::register');
    }

    public function doRegister(Request $request)
    {
    	$validateInput = [
                            'name' => 'required|min:3',
                            'email' => 'required|email',
                            'password' => 'required|confirmed|min:6',
                         ];

        $customError =  [
                            'exists' => 'You are not registered yet'
                        ];

        $this->validate($request, $validateInput, $customError);

        $userLogin = MemberLogin::where('email', $request->input('email'))
        						->where('channel_id', 0)
        						->first();

        if (!$userLogin) {
        	//not exist create new one
        	$userData = array(
        						'name' => $request->input('name'),
        						'email' => $request->input('email'),
        						'password' => Hash::make($request->input('password')),
        						'channel_id' => 0,
        					 );
            $newUserLogin = MemberLogin::create($userData);
            unset($userData['password']);
            unset($userData['channel_id']);
            Member::updateOrCreate($userData);

            if (config('zmember.need_verified_email')){
            	$this->sendEmail($userData);
            	return Redirect::to('register')->with('status', 'update berhasil, silahkan check email anda untuk verifikasi');
            } else {
            	MemberLogin::where('id', $newUserLogin->id)
            			->update(['status' => 1]);
            	return Redirect::to('register')->with('status', 'success, account anda sudah active');
            }

        } else {
            return redirect()->back()->with('error', 'The email address that you\'ve entered already exist.');
        }
        
    }

    public function sendEmail($user) 
    {

    }

}