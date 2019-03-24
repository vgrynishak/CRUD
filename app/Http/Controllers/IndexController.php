<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
//use Symfony\Component\HttpFoundation\Session\Storage;
use Illuminate\Support\Facades\Storage;
use App\Document;
use App\File;

class IndexController extends Controller
{

    public function public(Request $request){
        return view('welcome');
    }

    public function admin(Request $request){
        if ($request->session()->has('id'))
            return redirect()->route('home');
        return view('admin');
    }

    public function login(Request $request){
        if (($id = Admin::check_user($request['user'], hash('whirlpool',$request['password'])))) {
            $request->session()->put('id',$id);
            $request->session()->put('user',$request['user']);
            return;
        }
        return "Помилка вводу";
    }

    public function logout(Request $request){
        if ($request->session()->has('id')) {
            $request->session()->forget('id');
            $request->session()->forget('user');
            return redirect()->route('home');
        }
        else
            abort('404');
    }
    
    public function add(Request $request){
        if ($request->session()->has('id')){
            return view('add');
        }
        else
            abort('404');
    }

    public function add_file(Request $request){
        if (!$request->session()->has('id')){
            abort('404');
        }
        $title = $request['title'];
        if (Document::is_exist($title))
            return "Така назва файлу вже існує.";
        $names = array();
        foreach ($request->file('files') as $file) {
            if ($file->getClientOriginalExtension() != 'pdf')
                return "Формат файла повинен бути pdf";
            $path = time().$file->getClientOriginalName();
            $names[$file->getClientOriginalName()] = storage_path('app/public').'/'.$path;
            Storage::disk("public")->put($path, $file);
        }
        $id = Document::add_doc($title);
        foreach ($names as $name => $path_to){
            File::add_file($id,$name, $path_to);
        }
        return ;
    }

    public function lists(Request $request){
        $list = Document::get_all();
        return view('lists', ['list'=>$list]);
    }

    public function delete(Request $request){
        Document::delete_doc($request['id']);
        return Document::get_all();
    }

    public function show_doc(Request $request){
        return File::show_file($request['id']);
    }

    public function delete_file(Request $request){
//        return $request['id_file'];
        File::delete_file($request['id_file']);
        return File::show_file($request['id_doc']);
    }

    public function update_doc(Request $request){
         if (Document::is_exist($request['title']))
            return "Така назва файлу вже існує.";
         Document::update_title($request['id'],$request['title']);
            return ;
    }
}
