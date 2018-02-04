<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //获取粉丝的数
    public function fans(){
        return $this->hasMany('\App\Fan','star_id','id');
    }
    //获取关注数
    public function stars(){
        return $this->hasMany('\App\Fan','fan_id','id');

    }
    //获取文章数
    public function posts(){
       return $this->hasMany('\App\Post','user_id','id');
    }
    //是否关注某个用户 当前id是否被某个uid粉了
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }
    //这个用户是否被当前id粉了
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();

    }
    //增加关注我要关注的
    public function doFan($uid){
        $fan=new \App\Fan();
        $fan->star_id=$uid;
        return $this->stars()->save($fan);
    }
    //取消关注
    public function dounFan($uid){
        $fan=new \App\Fan();
        $fan->star_id=$uid;
        return  $this->stars()->delete($fan);
    }
}
