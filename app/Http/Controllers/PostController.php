<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::all();

        return view('admin.posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate input
        $inputs=request()->validate([
            'title'=>'required|min:2|max:255',
            'user_id'=>'required',
            'text_image'=>'file',
            'body'=>'required'
        ]);
        if(request('text_image')){
            $inputs['text_image']=$request->text_image;
            //rename image
            $reImg=time().'.'.$inputs['text_image']->getClientOriginalExtension();
            //save image to path
            $dest=public_path('/images');
            //move file
            $inputs['text_image']->move($dest,$reImg);



        // }

        $post=new Post();

        $post['title']=$request->title;
        $post['user_id']=$request->user_id;
        $post['text_image']=$reImg;
        $post['body']=$request->body;

        $post->save();

        return redirect('/admin')->with('msg','Data updates successfully');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $postItem=Post::findorFail($id);
        // return view('blog-post',['postItem'=>$postItem]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::findorFail($id);
        $post->delete();

        return redirect('/admin');
    }
}
