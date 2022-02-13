<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::with('user', 'commet')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'user_id'=> 'required',
            'title'=> 'required',
            'description'=> 'required',
            'image'=>'nullable|image|mimes:jpg,jpeg,png,gif,jfif|max:1999'
        ]);
        $request -> file('image')->store('public/images');
        $post = new Post();
        $post->user_id = $request->user_id;
        $post->title = $request -> title;
        $post->description = $request -> description;
        $post->image =$request->file('image')->hashName();
        $post->save();
        return response()->json([
            'massage'=>'Post is created', 
            'data'=> $post
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::with('user', 'comment')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'user_id'=> 'required',
            'title'=> 'required',
            'description'=> 'required',
        ]);
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return response()->json([
            'massage'=>'Post is updated', 
            'data'=> $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Post::destroy($id);
        if($isDeleted == 1){
            return response()->json(['massage'=>'Post is deleted'], 200);
        }else{
            return response()->json(['massage'=>'Not Found'], 404);
        }
    }
}
