<?php

namespace App;

use App\Model;

class Fan extends Model
{
    //关联用户取出粉丝用户信息
    public function fuser(){
        return $this->hasOne('\App\User','id','fan_id');
    }
    //关联用户取出关注用户的信息
    public function  suser(){
        return $this->hasOne('\App\User','id','star_id');
    }

}
