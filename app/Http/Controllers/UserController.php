<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
class UserController extends Controller
{
    //
    public function setting(User $user)
    {
      return view('user.setting',compact('user'));
    }

    public function settingStore(User $user)
    {
//        dd(request()->all());
       if(null !=request()->file('avatar')){
           $path = request()->file('avatar')->storePublicly(md5(time()));
           $realPath = asset('storage/' . $path);
           $user->photo = $realPath;
       }

        $user->name=request('name');
        $user->save();
        return back();
    }
}
