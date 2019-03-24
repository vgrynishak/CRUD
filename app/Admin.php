<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Admin
{
    //
    public static function check_user($user, $password){
        return DB::table('admins')->where('user',$user)->where('password', $password)->value('id');
    }
    public static function get_user($id){
        return DB::table('admins')->where('id',$id)->value('user');
    }
}
