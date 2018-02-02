<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class RegisterController extends Controller
{
    //
    public function index()
    {

            return view('register.index');
    }

    public function register(User $user)
    {

        //验证
        $this->validate(request(),[
           'name'=>'required|min:3|max:10|unique:users,name',
           'email'=>'required|min:3|email|unique:users,email',
           'password'=>'required|min:3|max:10|confirmed',
        ]);
        //逻辑
        $user->name=request('name');
        $user->email=request('email');
        $user->password=bcrypt(request('password'));
        $user->save();
        //渲染
        return redirect('/login');
    }

}
