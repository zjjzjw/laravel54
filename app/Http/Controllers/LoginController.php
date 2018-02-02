<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login.index');
    }

    public function login()
    {
        //验证
        $this->validate(request(),[
           'email'=>'required|email',
           'password'=>'required',
            'is_remember'=>''
        ]);

        //逻辑
        $user=request(['email','password']);
        if(null !=request('remember')){
            $remember=boolval(request('is_remember'));
        }else{
            $remember=false;
        }
        if(true==\Auth::attempt($user,$remember)){
            return redirect('/posts');
        }
        return back();
    }
    public  function logout(){
      \Auth::logout();
      return redirect('/login');
    }

}
