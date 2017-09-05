<?php

namespace App\Http\Controllers;

use App\Category;
use App\Message;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function show()
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);

        $category=Category::paginate(5);
        return view('category.NewCategory')->with(['category'=>$category,'countmessages'=>$countmessages]);
    }

    public function store(Request $request)
    {

        $name=$request->input('namecategory');
        $category=new Category();
        $category->name=$name;
        $category->save();


    }

    public function edit($id)
    {
        $category=Category::find($id);

    }

    public function delete($id)
    {
        $category=Category::find($id);
        foreach ($category->post as $item)
        {
            $post=Post::find($item->id);
            $post->delete();
        }
        $category->delete();
        return Redirect::back();
    }
    public function update(Request $request,$id)
    {
        $name=$request->input('namecategory');

        $category=Category::find($id);
        $category->name=$name;
        $category->update();

        return Redirect::back();

    }

}
