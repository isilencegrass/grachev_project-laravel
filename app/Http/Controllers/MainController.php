<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class MainController extends Controller {


    public function home(Request $request)
    {
        $query = $request->input('search');
        $posts = \App\Models\Posts::with('user')
            ->when($query, function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(10);

        return view('home', compact('posts'));
    }

    public function about() {
        return view('about');
    }

}
