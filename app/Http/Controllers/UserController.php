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
    //
    public function show(User $user){
        //这个人的粉丝数 关注数 文章数
        $user=User::withCount(['posts','fans','stars'])->find($user->id);
        //这个人的文章列表
        $posts=$user->posts()->orderBy('created_at','desc')->take(10)->get();
        //这个人的粉丝的粉丝数 关注数 文章数
        $fans=$user->fans;
        $fusers=User::whereIn('id',$fans->pluck('fan_id'))->withCount(['posts','fans','stars'])->get();
        //这个人关注的 粉丝数 关注数 和文章数

       $stars=$user->stars;

        $susers=User::whereIn('id',$stars->pluck('star_id'))->withCount(['posts','fans','stars'])->get();

        return view('user.show',compact('user','posts','fusers','susers'));
    }

    public function fan(User $user){
        $me=\Auth::user();
        $me->doFan($user->id);

        return[
            'error'=>0,
            'msg'=>''
        ];
    }
    public function unFan(User $user){
        $me=\Auth::user();
        $me->dounFan($user->id);
        return[
            'error'=>0,
            'msg'=>''
        ];
    }
}
