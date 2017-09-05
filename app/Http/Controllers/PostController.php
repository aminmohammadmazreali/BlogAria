<?php

namespace App\Http\Controllers;

use App\Category;
use App\Message;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function new()
    {
        $category = Category::all();
        if (count($category)==0)
        {
            return Redirect('/category');
        }
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);
        return view('post.NewPost')->with(['category' => $category,'countmessages'=>$countmessages]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'subject' => 'required|min:3',
            'text' => 'required|min:3'

        ], [
            'subject.min' => 'عنوان وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',
            'subject.required' => 'شما باید  عنوان را وارد کنید. ',
            'text.required' => 'شما باید  متن  را وارد کنید. ',
            'text.min' => 'متن وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',


        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject=$request->input('subject');
        $text=$request->input('text');
        $category=$request->input('category');

        if(Input::hasFile('image')){
            $file=Input::file('image');
            $image_path=time().$file->getClientOriginalName();
            $file->move('file/post' ,$image_path);


        }



        $post=new Post();
        $post->subject=$subject;
        $post->text=$text;
        $post->category_id=$category;
        $post->image_name=$image_path;



        try {

            $post->save();

            return Redirect('/post');

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
        }

    }

    public function showposts()
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);
        $post=Post::paginate(5);
        return view('post.PostList')->with(['post'=>$post,'countmessages'=>$countmessages]);
    }
    public function edit($id)
    {
        $post=Post::find($id);
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);
        $category=Category::all()->whereNotIn('id',$post->category_id);

        return view('post.EditPost')->with(['post'=>$post,'category'=>$category,'countmessages'=>$countmessages]);
    }
    public function update(Request $request,$id)
    {
        $validator = \Validator::make($request->all(), [
            'subject' => 'required|min:3',
            'text' => 'required|min:3'

        ], [
            'subject.min' => 'عنوان وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',
            'subject.required' => 'شما باید  عنوان را وارد کنید. ',
            'text.required' => 'شما باید  متن  را وارد کنید. ',
            'text.min' => 'متن وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',


        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject=$request->input('subject');
        $text=$request->input('text');
        $category=$request->input('category');

        $post=Post::find($id);

        if(Input::hasFile('image')){
            $file=Input::file('image');
            $image_path=time().$file->getClientOriginalName();
            $file->move('file/post' ,$image_path);

            $post->image_name=$image_path;

        }


        $post->subject=$subject;
        $post->text=$text;
        $post->category_id=$category;


        try {

            $post->update();

            return Redirect('/post');

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
        }
    }

    public function delete($id)
    {
        $post=Post::find($id);
        $post->delete();
        return  Redirect('/post');
    }


}
