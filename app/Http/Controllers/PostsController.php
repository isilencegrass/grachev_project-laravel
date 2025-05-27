<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $media = null;
        if ($request->hasFile('image')) {
            $media = [$request->file('image')->store('posts', 'public')];
        }

        $post = Posts::create([
            'user_id'      => auth()->id(),
            'title'        => $validated['title'],
            'slug'         => Str::slug($validated['title']) . '-' . uniqid(),
            'content'      => $validated['content'],
            'media'        => $media ? json_encode($media) : null,
            'is_published' => true,
        ]);

        return redirect()->back()->with('success', 'Пост успешно создан!');
    }

    public function like($id)
    {
        $post = Posts::findOrFail($id);
        $userId = auth()->id();
        $likedUsers = $post->liked_users ?? [];

        if (in_array($userId, $likedUsers)) {
            $likedUsers = array_diff($likedUsers, [$userId]);
            $post->likes = max(0, $post->likes - 1);
        } else {
            $likedUsers[] = $userId;
            $post->likes++;
        }

        $post->liked_users = array_values($likedUsers); 
        $post->save();

        return back();
    }

}