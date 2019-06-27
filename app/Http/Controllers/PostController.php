<?php
/**
 * Created by PhpStorm.
 * User: Eze
 * Date: 23/06/2019
 * Time: 11:12 PM
 */
namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'create', 'show']);
        $this->middleware('admin')->except(['index', 'create', 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'DESC')->with('author')->paginate(5);
        if($request->wantsJson()){
            return response()->json($posts);
        }else{
            return view('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return mixed
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();

        # Validate Slug.
        $slug = $aux_slug = Str::slug($data['title']);
        $c = 0;
        while (Post::where('slug', $aux_slug)->exists()){
            $aux_slug = $slug;
            $aux_slug .= $c;
        }
        $slug = $aux_slug;

        # Store New Image
        $image = $data['image'];  // your base64 encoded
        $imageName = $slug . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        \Image::make($image)->save(public_path('uploads/') . $imageName);


        $data = [
            'title' => $data['title'],
            'subtitle' => $data['subtitle'],
            'content' => $data['content'],
            'author_id' => Auth::user()->id,
            'image' => $imageName,
            'slug' => $slug
        ];

        return Post::create($data);
    }

    /**
     * Display the specified resource.
     *
     *
     * @param Request $request
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|View
     */
    public function show(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        # return 404 if post not found
        if(!empty($post)){
            $post->load('author');
            $related_posts = Post::where('_id', '!=', $post->_id)->limit(5)->get();
            if($request->wantsJson()){
                return response()->json($post);
            }else{
                return view('single-post', compact('post', 'related_posts'));
            }
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return mixed
     */
    public function update(PostRequest $request, Post $post)
    {
        # Post to update
        $post_update = Post::find($post->toArray())->first();
        $image = $request->image;  // your base64 encoded

        $data = $request->all();

        # if the request image is not a new image, don't storage.
        if(strpos($image, 'data:') !== false){
            $imageName = $post_update->slug . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($image)->save(public_path('uploads/') . $imageName);
            $post_update->image = $imageName;
        }

        $post_update->title = $data['title'];
        $post_update->subtitle = $data['subtitle'];
        $post_update->content = $data['content'];
        $post_update->save();

        return $post_update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
