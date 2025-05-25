<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class MainController extends Controller {


    public function home()
    {
        $posts = Posts::with('user')->latest()->paginate(10); // 10 постов на страницу
        return view('home', compact('posts'));
    }

    public function about() {
        return view('about');
    }

}
