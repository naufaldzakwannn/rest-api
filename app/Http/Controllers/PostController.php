<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostDetailResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // return response()->json(['data' => $posts]);

        // API Resource => membedakan hasil yang diberikan model dan frontend
        // Penulisan PostResource Collection untuk data yang dikembalikan lebih dari satu atau array
        return PostDetailResource::collection($posts->loadMissing('writer:id,username'));
    }

    // Untuk menampilkan data yang diinginkan
    // Data yang ingin ditampilan terletak pada PostResource.php
    public function show($id)
    {
        // penggunaan new untuk expect hasil yg hasilnya satu
        // Penggunaan with('writer:id,username') hanya untuk data yang mau ditampilkan saja dan tidak boleh pakai space
        $post = Post::with('writer:id,username')->findOrFail($id);
        return new PostDetailResource($post);
    }

    public function show2($id)
    {
        $post = Post::findOrFail($id);
        return new PostDetailResource($post);
    }


    // Insert Data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
    // request $request untuk menangkap input dari user
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        
    }
}
