<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Galery;
use App\Message;
use App\Note;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FrontController extends Controller
{
    public function home()
    {
        $note=Note::all()->random(1);
        $galery=Galery::paginate(2);

        $post=Post::paginate(5);

        return view('frontblog.index')->with(['note'=>array_first($note),'news'=>$post,'galery'=>$galery]);
    }

    public function news()
    {
        $note=Note::all()->random(1);
        $galery=Galery::paginate(2);

        $post=Post::paginate(5);

        return view('frontblog.index')->with(['note'=>array_first($note),'news'=>$post,'galery'=>$galery]);
    }

    public function newsone($id)
    {
        $note=Note::all()->random(1);
        $galery=Galery::paginate(2);

        $post=Post::find($id);

        return view('frontblog.postbody')->with(['note'=>array_first($note),'news'=>$post,'galery'=>$galery]);
    }

    public function bio()
    {
        $note=Note::all()->random(1);
        $galery=Galery::paginate(2);
        return view('frontblog.about')->with(['note'=>array_first($note),'galery'=>$galery]);
    }

    public function interview()
    {
        $note=Note::all()->random(1);
        $galery=Galery::paginate(2);
        $post=Post::paginate(5)->where('category_id',-1);
        return view('frontblog.interview')->with(['note'=>array_first($note),'news'=>$post,'galery'=>$galery]);
    }

    public function note()
    {
        $note=Post::all()->random(1);
        $galery=Galery::paginate(2);
        $post=Note::paginate(4);
        return view('frontblog.note')->with(['note'=>array_first($note),'news'=>$post,'galery'=>$galery]);
    }

    public function noteone($id)
    {
        $note=Post::all()->random(1);
        $galery=Galery::paginate(2);
        $post=Note::find($id);
        return view('frontblog.noteblade')->with(['note'=>array_first($note),'news'=>$post,'galery'=>$galery]);
    }

    public function gallery()
    {
        $post=Galery::paginate(6);
        $note=Note::all()->random(1);
        $galery=Post::paginate(2);
        return view('frontblog.galery')->with(['note'=>array_first($note),'news'=>$post,'galery'=>$galery]);
    }

    public function galleryone($id)
    {
        $post=Galery::find($id);
        $note=Note::all()->random(1);
        $galery=Post::paginate(2);
        return view('frontblog.galerybody')->with(['note'=>array_first($note),'news'=>$post,'galery'=>$galery]);
    }

    public function contact()
    {
        $note=Note::all()->random(1);
        $galery=Galery::paginate(2);
        return view('frontblog.contact')->with(['note'=>array_first($note),'galery'=>$galery]);
    }

    public function contactstore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|min:3',
            'text' => 'required|min:3',
            'email'=>'required|email'

        ], [
            'subject.min' => 'نام وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',
            'subject.required' => 'شما باید  نام خود را وارد کنید. ',
            'text.required' => 'شما باید  متن  را وارد کنید. ',
            'text.min' => 'متن وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',
            'email.required'=> 'شما باید یک ایمیل وارد کنید'

        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $name=$request->input('name');
        $text=$request->input('text');
        $email=$request->input('email');

        $message=new Message();
        $message->name=$name;
        $message->text=$text;
        $message->email=$email;

        try {

            $message->save();

            return Redirect::back()->withErrors(['پیام شما با موفقیت ارسال شد']);

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
        }
    }

    public function storecomment(Request $request,$id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|min:3',
            'text' => 'required|min:3',
            'email'=>'required|email'

        ], [
            'subject.min' => 'نام وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',
            'subject.required' => 'شما باید  نام خود را وارد کنید. ',
            'text.required' => 'شما باید  متن  را وارد کنید. ',
            'text.min' => 'متن وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',
            'email.required'=> 'شما باید یک ایمیل وارد کنید'

        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $name=$request->input('name');
        $text=$request->input('text');
        $email=$request->input('email');

        $comment=new Comment();
        $comment->user_name=$name;
        $comment->user_email=$email;
        $comment->text=$text;
        $comment->post_id=$id;
        $comment->status=0;



        try {

            $comment->save();

            return Redirect::back()->withErrors(['نظر شما با موفقیت در سیستم ذخیره شد و بعد از تایید مدیر نمایش داده خواهد شد.']);

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
        }
    }
}
