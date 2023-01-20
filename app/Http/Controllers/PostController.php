<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
//use App\Http\Controllers\getClientOrginalName;

class PostController extends Controller
{
    // to protect controller from unauthorized users
    public function __construct()
    {
       $this->middleware('auth'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post=Post::latest()->paginate(4);
        return view('posts.index')->with('post', $post);
    }

    //Post posttrashed funcation
    public function posttrashed()
    {
        $post=Post::onlyTrashed()->get();
        return view('posts.trashed')->with('post', $post);

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'	=>'required',
            'content'=>'required',
            'photo'	=>'required | image',
        ]);
        $photo= $request->photo;
        $newphoto=time().$photo->getClientOriginalName();
        $photo->move('uploads/posts',$newphoto);

        $post=Post::create([
            'title'	=>$request->title,
            'content'=>$request->content,
            'photo'	=>'uploads/posts/'.$newphoto,
            'user_id'	=>Auth::id(),
            'slug'	=> str::slug($request->title)
        ]);
        return redirect()->back();
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post=Post::where('slug', $slug)->first();
        return view('posts.show')->with('post', $post);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        return view('posts.edit')->with('post', $post);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=Post::find($id);
        $this->validate($request, [
            'title'	=>'required',
            'content'=>'required',
        ]);
        if($request->has('photo')){
            $photo= $request->photo;
        $newphoto=time().$photo->getClientOrginalName();
        $photo->move('uploads/posts',$newphoto);
        $post->photo='uploads/posts/'.$newphoto;
        }

        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();
        return redirect()->back();

    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->back();
    }
    

    //sdelete funcation

    public function sdelete($id)
    {
        $post=Post::withTrashed('id', $id)->first();
        $post->forceDelete();
        return redirect()->back();

    }
   

    //restore function

    public function restore($id)
    {
        $post=Post::withTrashed('id', $id)->first();
        $post->restore();
        return redirect()->back();
    }


}
