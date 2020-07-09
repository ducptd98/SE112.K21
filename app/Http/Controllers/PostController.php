<?php

namespace App\Http\Controllers;

use App\Model\Post;
use App\Model\Comment;
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
        $data = new Post();
        $posts = $data->with('comments')->paginate(25);
        return response()->json($posts);
    }

    public function get_tag(Request $request){
        $data = new Post();
        $posts = $data->with('comments')->where('tag','like','%'.$request->parameter.'%')->paginate(25);
        return response()->json($posts);
    }

    public function get_recently(){
        $data = new Post();
        $posts = $data->with('comments')->orderBy('updated_at','desc')->take(20)->get();
        return response()->json($posts);
    }

    public function get_favourite(){
        $data = new Post();
        $posts = $data->with('comments')->orderBy('like','desc')->paginate(25);
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Post();
        $data->title = $request->title;
        $data->content = $request->content;
        $data->tag = $request->tag;
        if($data->save()){
            return response()->json($data);
        }
        return 500;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->title = $request->title;
        $post->content = $request->content;
        $post->tag = $request->tag;
        $post->like = $request->like;
        if($post->save()){
            return response()->json($post);
        }
        return 500;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->delete()){
            return 200;
        }
        return 500;
    }
}
