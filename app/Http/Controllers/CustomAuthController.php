<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Laravel\Socialite\Facades\Socialite;

class CustomAuthController extends Controller
{
    public function registeration(){
        return view('auth.registeration');
    }

    public function registerUser(Request $request){
        $request->validate([
            'username'=>'required|unique:users',
            'password'=>'required|min:8'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        $res = $user->save();

        if($res){
            return back()->with('success','You registered successfully');
        }else{
            return back()->with('fail', 'something wrong');
        }
    }

    //로그인 유지 체크 -> 세션의 설정을 바꿈.
    public function login(){
       return view('auth.login');
    }

    public function loginUser(Request $request){
        $request->validate([
                'username'=>'required',
                'password'=>'required'
        ]);

        $user = User::where('username','=',$request->username)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('loginId', $user->id);
                $request->session()->put('loginUsername', $user->username);
                return redirect('board');
            }else{
              return back()->with('fail', '아이디 혹은 비밀번호가 일치하지 않습니다');
            }
        }else{
            return back()->with('fail', '아이디 혹은 비밀번호가 일치하지 않습니다');
        }
    }

    public function loginNaver(){
        return Socialite::driver('naver')->redirect();
    }

    public function loginNaverCallBack(Request $request){
       try{
         $user = Socialite::driver('naver')->user();
       }catch(\Exception $e){
           return redirect('/login');
       }

        if($user){
            $request->session()->put('loginId', $user->id);
            $request->session()->put('loginUsername', $user->name);
        }

        return redirect('/board');
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
