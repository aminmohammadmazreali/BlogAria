<?php

namespace App\Http\Controllers;

use App\Galery;
use App\Images;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function showgalery()
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);
        $galery = Galery::paginate(5);
        return view('galery.GaleryList')->with(['galery' => $galery,'countmessages'=>$countmessages]);
    }

    public function newgalery()
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);
        return view('galery.NewGallery')->with(['countmessages'=>$countmessages]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|min:3',

        ], [
            'subject.min' => 'عنوان وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',
            'subject.required' => 'شما باید  عنوان را وارد کنید. ',
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $name = $request->input('name');


        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $image_path = time() . $file->getClientOriginalName();
            Image::make($file->getRealPath())->fit(500, 400)->save('file/galery/head/'.$image_path)->destroy();

        }

        $galery = new Galery();
        $galery->name=$name;

        $galery->image_name = $image_path;


        try {

            $galery->save();



        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
        }

        foreach(Input::file("images") as $file) {

            $image_path = time() . $file->getClientOriginalName();
            $file->move('file/galery', $image_path);

            $images = new Images();
            $images->galery_id=$galery->id;
            $images->image_name = $image_path;
            try {

                $images->save();

            } catch (\Illuminate\Database\QueryException $e) {
                return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
            }
        }


        return Redirect('/gallery');
    }

    public function edit($id)
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);
        $galery = Galery::find($id);
        return view('galery.EditGallery')->with(['galery' => $galery,'countmessages'=>$countmessages]);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|min:3',

        ], [
            'subject.min' => 'عنوان وارد شده باید بیشتر از 3 کاراکتر داشته باشد. ',
            'subject.required' => 'شما باید  عنوان را وارد کنید. ',
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        $name = $request->input('name');

        $galery =Galery::find($id);
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $image_path = time() . $file->getClientOriginalName();
            Image::make($file->getRealPath())->fit(500, 400)->save('file/galery/head/'.$image_path)->destroy();
            $galery->image_name = $image_path;
        }

        $galery->name=$name;

        try {

            $galery->update();

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
        }

        if (Input::hasFile('images')) {
            foreach (Input::file("images") as $file) {

                $image_path = time() . $file->getClientOriginalName();
                $file->move('file/galery', $image_path);

                $images = new Images();
                $images->galery_id = $id;
                $images->image_name = $image_path;
                try {

                    $images->save();

                } catch (\Illuminate\Database\QueryException $e) {
                    return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
                }
            }
        }


        return Redirect('/gallery');
    }

    public function delete($id)
    {
        $galery = Galery::find($id);

        foreach($galery->images as $item)
        {
            $image=Images::find($item->id);
            $image->delete();
        }

        $galery->delete();
        return Redirect('/gallery');
    }

    public function deleteimage($id)
    {
        $image=Images::find($id);
        $image->delete();
        return Redirect::back();
    }
}
