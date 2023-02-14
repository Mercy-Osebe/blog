<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
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
        // to show posts that were created by the logged in user.
        // $id = Auth::id(); 
        // $posts = Post::where("user_id", "=", $id)->get(); 
        
        // gets all posts

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
        $request->validate([
            'title'=>'required|min:2|max:255',
            'user_id'=>'required',
            'text_image'=>'file',
            'body'=>'required'
        ]);
        if($request->hasFile('text_image')){
            $img=$request->text_image;
            //rename image
            $reImg=time().'.'.$img->getClientOriginalExtension();
            //save image to path
            $dest=public_path('/images');
            //move file
            $img->move($dest,$reImg);
        }
        else{
            $reImg="nothing.png";
        }

        $post=new Post();

        $post['title']=$request->title;
        $post['user_id']=$request->user_id;
        $post['text_image']=$reImg;
        $post['body']=$request->body;

        $post->save();

        return redirect('/admin/post/index')->with('msg','Post was created successfully');
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
        $post=Post::findorFail($id);
        $this->authorize('view',$post); //this controller has utilised the postpolicy rules
        return view('admin.posts.edit',['post'=>$post]);
        

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
        $request->validate([
            'title'=>'required|min:2|max:255',
            'user_id'=>'required',
            'text_image'=>'file',
            'body'=>'required'
        ]);
        if($request->hasFile('text_image')){
            $img=$request->text_image;
            //rename image
            $reImg=time().'.'.$img->getClientOriginalExtension();
            //save image to path
            $dest=public_path('/images');
            //move file
            $img->move($dest,$reImg);
        }
        else{
            $reImg="nothing.png";
        }
        $post=new Post();

        $post['title']=$request->title;
        $post['user_id']=$request->user_id;
        $post['text_image']=$reImg;
        $post['body']=$request->body;

        // $this->authorize('update',$post);
        $post->update();

        return redirect('/admin/post/index')->with('update_msg','post updated successfully');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hard coded not utilised the policy
        
        $post=Post::findorFail($id);
        if(Auth::user()->id !== $post->user_id){
            // what happens when an un-authenticated user tries to delete a post.

        }
        else{
            $post->delete();
            return redirect('/admin')->with('deletemsg','Post deleted successfully');
        }       
    }
}
