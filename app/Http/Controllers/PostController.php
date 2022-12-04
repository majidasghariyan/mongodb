<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Validator;

class PostController extends Controller
{
    public function all_show()
    {
        $posts = Post::orderBy('id', 'DESC')->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $request->merge(['slug'=>str_replace(' ','-',$request->slug)]);

        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'body' => 'required',
            'slug' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),421);       
        }

        $post = new Post;
 
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;
 
        $post->save();
 
        return response()->json([
            'message' => 'با موفقیت ذخیره شد.'
        ], 200);
    }

    public function single_show(Post $post)
    {
        return response()->json($post,200);
    }

    public function update(Request $request,Post $post)
    {
        $request->merge(['slug'=>str_replace(' ','-',$request->slug)]);

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'body' => 'required',
            'slug' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),421);       
        }

        // $post = Post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;
        $post->save();
        
        return response()->json([
            'message' => 'با موفقیت بروز رسانی شد.'
        ], 200);    

    }

    public function single_delete(Request $request, Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'با موفقیت  حذف شد.'
        ], 200);
    }
 
}
