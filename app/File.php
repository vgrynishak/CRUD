<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class File extends Model
{

//        $table->bigIncrements('id');
//        $table->string('name_file');
//        $table->string('path');
//        $table->bigInteger('doc_id')->unsigned();
//        $table->foreign('doc_id')->references('id')->on('documents')->onCascade('delete');
//        $table->date('date')->useCurrent();
    public static function add_file($id_doc, $names, $path){
        return DB::table('files')->insert([
            'name_file'=>$names,
            'path' => $path,
            'doc_id'=> $id_doc
        ]);
    }

    public static function show_file($id_doc){
        return DB::table('files')->join('documents', 'files.doc_id', '=', 'documents.id')
            ->select('name_file','path', 'files.id')
            ->where('doc_id', $id_doc)
            ->get();
    }

    public static  function delete_file($id){
        return DB::table('files')->where('id',$id)->delete();
    }
}
