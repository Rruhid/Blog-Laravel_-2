<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use Purifier;
use Storage;
use Session;
use Image;
class PostController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
   
       }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index()
    {
        
       $posts=Post::orderBy('id','desc')->paginate(5);
       return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view ('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      $this->validate($request,array(
        'title'=>'required|max:255',
        'category_id'=>'required|integer',
        'body'=>'required|max:2000',
        'slug'=>'required|alpha_dash|min:5|max:255|unique:posts,slug',
        'featured_image'=>'sometimes|image'

      ));
        $post=new Post;
        $post->title=$request->title;
        $post->body=Purifier::clean($request->body);
        $post->category_id=$request->category_id;
        $post->slug=$request->slug;
      
        if($request->hasFile('featured_image')){
            //gotutduk
            $image=$request->file('featured_image');
            //ext elave eledik
            $filename=time().'.'.$image->getClientOriginalExtension();
            //yer melum etdik
            $location=public_path('images/'.$filename);
            Image::make($image)->resize(800 ,400)->save($location);
            $post->image=$filename;

        }

        $post->save();
        $post->tags()->sync($request->tags,false);
        Session::flash('success','Blog saxlanilib');
        return redirect()->route('posts.show',$post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categories=Category::all();
        $cats=array();
        foreach($categories as $category){
            $cats[$category->id]=$category->name;
        }
        $tags=Tag::all();
        $tags2=array();
        foreach($tags as $tag){
            $tags2[$tag->id]=$tag->name;
        
        }
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
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
            $post=Post::find($id);
           
               $this->validate($request,array(
            'category_id'=>'required|integer',
            'title'=>'required|max:255',
            'slug'=>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'body'=>'required',
            'featured_image'=>'image'
               ));
             
        $post=Post::find($id);
        $post->title=$request->input('title');
        $post->category_id=$request->input('category_id');
        $post->body=Purifier::clean($request->input('body'));
        $post->slug=$request->input('slug');

        if($request->hasFile('featured_image')){
        //kohnesini silmek
        $image=$request->file('featured_image');
        //ext elave eledik
        $filename=time().'.'.$image->getClientOriginalExtension();
        //yer melum etdik
        $location=public_path('images/'.$filename);
        Image::make($image)->resize(800 ,400)->save($location);
            $oldFilename=$post->image;

        $post->image=$filename;
        Storage::delete($oldFilename);
        }


        $post->save();

     if (isset($request->tags)){
        $post->tags()->sync($request->tags);
     }else{
         $post->tags()->sync(array());
     }
        Session::flash('success','This post was updated');
        return redirect()->route('posts.show',$post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->tags()->detach();
        $post->delete();
        Session::flash('success','The post was sucessfully deleted');
        return redirect()->route('posts.index');
    }
}
