<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image upload validation
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public');
            $data['image'] = $imagePath;
        }

        Auth::user()->posts()->create($data);

        session()->flash('post_created', true);

        return redirect()->route('posts.index');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::when($search, function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(10); // Change the number to adjust posts per page

        return view('posts.index', compact('posts'));
    }

}
