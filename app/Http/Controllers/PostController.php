<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Services\PostService;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    private $postService;

    public function __construct( PostService $postService )
    {
        $this->postService = $postService;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('categories')->paginate(15);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        DB::transaction(function ()  use ($request)
        {
            $post = Post::create([
                'title' => $request->title,
                'description' => $request->description,
                ]
            );
            //add categories to post
            $this->postService->addCategories( $post->id, $request->categories );

            // add post to cache
            $cachedPost = Redis::get('post_' . $post->id);
            if(!isset($cachedPost)) {
                Redis::set('post_' . $post->id, $post);
            }
        });
        return redirect('posts')->with('success', 'New Post added.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $post->load('categories');
        $postCategories = $this->postService->getArrayCategories( $post->categories );
        return view('posts.edit', compact('post','categories','postCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        DB::transaction(function ()  use ($request, $post)
        {
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
            $this->postService->addCategories( $post->id, $request->categories );

            // dell post to cache
            Redis::del('post_' . $post->id);
            // Set a new key with the id
            Redis::set('post_' . $post->id, $post);

        });
        return redirect('posts')->with('success', 'Post correctly edited.');
    }

}
