<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function new()
    {
        $category=Category::all();
        return view('category.NewCategory')->with(['category'=>$category]);
    }

    public function store(Request $request)
    {

        $name=$request->input('name');

        $category=new Category();
        $category->name=$name;
        $category->save;
    }
}
