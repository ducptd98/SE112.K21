<?php

namespace App\Http\Controllers;

use App\Model\Post;
use App\Model\Comment;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{

    // Get all Tag

    public function getAllTag(){
        // return "tag";
        $data = new Post();
        $tags = $data->groupBy('tag')->pluck('tag');
        return response()->json($tags);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Auth::user()->name;
        $data = new Post();
        $posts = $data->with('comments')->with('user')->paginate(25);
        return response()->json($posts);
    }

    public function get_search(Request $request){
        $data = new Post();
        $posts = $data->with('comments')->with('user')->where('title','like','%'.$request->parameter.'%')->orWhere('tag','like','%'.$request->parameter.'%')->paginate(2);
        return response()->json($posts);
    }

    public function get_tag(Request $request){
        $data = new Post();
        $posts = $data->with('comments')->with('user')->where('tag','like','%'.$request->parameter.'%')->paginate(25);
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
        $data->user_id = $request->user_id;
        $data->link = $request->link;
        if ($data->save()) {
            return response()->json([
                'status'=> 200,
                'message'=> 'Post created successfully',
                'data'=>$data
            ]);
        }
        return response()->json([
            'status'=> 500,
            'message'=> 'Post created fail',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->json([
            'status'=> 200,
            'message'=> 'Get post successfully',
            'data'=>$post,
            'comments'=>$post->comments,
            'user'=>$post->user
        ]);
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
        if ($post->save()) {
            return response()->json([
                'status'=> 200,
                'message'=> 'Post updated successfully',
            ]);
        }

        return response()->json([
            'status'=> 500,
            'message'=> 'Post updated fail',
        ]);
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
