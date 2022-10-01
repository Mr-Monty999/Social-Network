<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Services\FileHandleService;
use App\Services\PostService;
use App\Services\ResponseService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostService::getAllPosts();

        // return ResponseService::json($posts);
        return view("welcome", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        if ($request->file("photo"))
            $data["photo"] = FileHandleService::uploadImage($request->file("photo"), "/images/posts");

        $post = Post::create($data);

        return ResponseService::json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = PostService::getPostById($id);
        return view("welcome", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = PostService::getPostById($id);

        return view("welcome", compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->all();
        if ($request->file("photo")) {
            if (FileHandleService::deleteImageIfExists($post->photo))
                $data["photo"] = FileHandleService::uploadImage($request->file("photo"), "/images/posts");
        }

        $post->update($data);

        return ResponseService::json($post, "تم تحديث المنشور بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        FileHandleService::deleteImageIfExists($post->photo);
        $post->delete();
        return ResponseService::json($post, "تم الحذف بنجاح");
    }
}
