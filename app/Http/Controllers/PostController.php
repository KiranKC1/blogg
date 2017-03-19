<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use Session;
use App\Tag;
use Intervention\Image\ImageManagerStatic as Image;
use Storage;
class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a variable and store all the blog posts from the database in  it
        $posts=Post::orderBy('id','desc')->paginate(10);
        //return a view and pass in the aboove variable into the view
        return view('posts.index')->with('posts',$posts);
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
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validate the data
     $this->validate($request, array(
            'title'=>'required|max:255',
            'slug'=>'required|min:5|max:255|alpha_dash',
            'category_id'=>'required|integer',
            'body'=>'required',
            'featured_image'=>'sometimes|image'
        ));
     //store in the database
    $post=new Post;
    $post->title=$request->title;
    $post->slug=$request->slug;
    $post->category_id=$request->category_id;
    $post->body=$request->body;
    //save image
    if($request->hasFile('featured_image')){
        $image=$request->file('featured_image');
        $filename=time() . '.' .$image->getClientOriginalExtension();//image intervention library use garera yo method use garna payo
        $location=public_path('images/'. $filename);
        Image::make($image)->resize(800,400)->save($location);  
        $post->image=$filename;      
    }
    
    $post->save();

    $post->tags()->sync($request->tags,false);//not to override other associations

    Session::flash('success','The blog post was successfully saved!');

     //redirect to another page
    return redirect()->route('posts.show', $post->id);

    }
    public function show($id)
    {
        $post= Post::find($id);
        return view('posts.show')->withPost($post);//with('post',$post);yesari ne milcha
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find post and save it in a variable and pass into the view
        $post= Post::find($id);
        $categories=Category::all();
        $cats=array();
        foreach ($categories as $category) {
            $cats[$category->id]=$category->name;//yo bujeko chaina!!
        }

        $tags=Tag::all();
        $tags2=array();
        foreach ($tags as $tag) {
            $tags2[$tag->id]= $tag->name;
        }//select expects associative array, id number of the tags
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
        //validate the data
        $post=Post::find($id);

         $this->validate($request, array(
            'title'=>'required|max:255',
            'slug'=>"required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
            'category_id'=>'required|integer',
            'body'=>'required',
            'featured_image'=>'image'
            ));

    
        //save the data to the database
        $post= Post::find($id);
        $post->title=$request->input('title');//input will get paramaeters from either the get or post 
        $post->category_id=$request->input('category_id');
        $post->slug=$request->input('slug');
        $post->body=$request->body;

        if ($request->hasFile('featured_image')){
        //add the new photo 
        $image=$request->file('featured_image');
        $filename=time() . '.' .$image->getClientOriginalExtension();//image intervention library use garera yo method use garna payo
        $location=public_path('images/'. $filename);
        Image::make($image)->resize(800,400)->save($location); 
        $oldFilename=$post->image;
        //update database
        $post->image=$filename;    
        //delete old photo
        Storage::delete($oldFilename);
        }

        $post->save();
        if(isset($request->tags)){
        $post->tags()->sync($request->tags,true);//we want to override other tags! pahilako tags haru ne pheri jancha flase garyo bhane
        }else{
            $post->tags()->sync(array());
        }//if tags haleko chaina bhane error aucha! soo if tag haleko cha bhane request ma ayeko jati value array ma pass huncha else value na bhako array pass huncha
        
        //set flash data with success message
         Session::flash('success','The blog post was successfully Updated!');

        //redirect with flash data to posts.show
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
        //find the post
        $post= Post::find($id);
        $post->tags()->detach();//remove any refernce to the post Tag model || jati pani post jun tag sangha related cha tyo sab lai hatauna
        Storage::delete($post->image);
        $post->delete();
        Session::flash('success','The post was successfully deleted');
        return redirect()->route('posts.index');
    }
}
