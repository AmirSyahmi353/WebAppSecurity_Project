<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show($slug)
   {
       return view('post', [
           'post' => Post::where('slug', '=', $slug)->first()
       ]);
   }

   public function create()
   {
       return view('posts.create');
   }

   public function store(Request $request)
   {
       if($request->isMethod('post')){
        $data = $request->all();
        echo "<pre>"; print_r($data); die;
       }
   }
}
