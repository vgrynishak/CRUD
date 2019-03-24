<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Document extends Model
{
    public static function is_exist($title){
        return DB::table('documents')->where('name_doc', $title)->exists();
    }
    public static  function add_doc($title){
        return DB::table('documents')->insertGetId(['name_doc'=>$title]);
    }

    public static  function get_all(){
        return DB::table('documents')->select('id','name_doc')->get();
    }

    public static  function delete_doc($id){
        return DB::table('documents')->where('id',$id)->delete();
    }

    public static function update_title($id,$title){
        return DB::table('documents')->where('id', $id)->update(['name_doc'=>$title]);
    }
}
