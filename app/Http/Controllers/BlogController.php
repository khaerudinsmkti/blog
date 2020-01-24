<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Category;

class BlogController extends Controller
{
    public function index(Posts $posts){
        $category_widget = Category::all();
        $data = $posts->orderBy('created_at','desc')->take(2)->get(); //hanya menampilkan 2 berita saja

        //$data = $posts->latest()->take(5)->get(); //Menampilkan 5 berita terbaru
        return view('blog', compact('data', 'category_widget'));
    }

    public function isi_blog($slug){
        $category_widget = Category::all();
        $data = Posts::where('slug', $slug)->get();
        return view('blog.isi_post', compact('data', 'category_widget'));
    }

    public function list_blog(){
        $category_widget = Category::all();
        $data = Posts::latest()->paginate(2);
        return view('blog.list_post', compact('data', 'category_widget'));
    }

    public function list_category(category $category){
        $category_widget = Category::all();

        $data = $category->posts()->paginate();
        return view('blog.list_post', compact('data', 'category_widget'));
        
    }

    public function cari2($cari){
        $category_widget = Category::all();

        $data = Posts::where('judul', $cari)->orWhere('judul','like','%'.$cari.'%')->paginate(6);
        return view('blog.list_post', compact('data', 'category_widget'));
        
    }

    public function cari(request $request){
        $category_widget = Category::all();

        $data = Posts::where('judul', $request->cari)->orWhere('judul','like','%'.$request->cari.'%')->paginate(6); //cari dapat dari form input name=cari
        return view('blog.list_post', compact('data', 'category_widget'));
        
    }

}
