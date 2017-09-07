<?php

namespace App\Http\Controllers;

use App\Message;
use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class NoteController extends Controller
{
    public function shownote()
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);

        $note = Note::paginate(5);
        return view('note.NoteList')->with(['note' => $note,'countmessages'=>$countmessages]);
    }

    public function newnote()
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);
        return view('note.NewNote')->with(['countmessages'=>$countmessages]);
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

        $subject = $request->input('subject');
        $text = $request->input('text');

        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $image_path = time() . $file->getClientOriginalName();
            Image::make($file->getRealPath())->fit(500, 400)->save('file/note/'.$image_path)->destroy();


        }

        $note = new Note();
        $note->subject = $subject;
        $note->text = $text;
        $note->image_name = $image_path;


        try {

            $note->save();

            return Redirect('/note');

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
        }

    }

    public function edit($id)
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);
        $note = Note::find($id);

        return view('note.EditNote')->with(['note' => $note,'countmessages'=>$countmessages]);
    }

    public function update(Request $request, $id)
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

        $subject = $request->input('subject');
        $text = $request->input('text');

        $note = Note::find($id);
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $image_path = time() . $file->getClientOriginalName();
            Image::make($file->getRealPath())->fit(500, 400)->save('file/note/'.$image_path)->destroy();

            $note->image_name = $image_path;

        }

        $note->subject = $subject;
        $note->text = $text;


        try {

            $note->update();

            return Redirect('/note');

        } catch (\Illuminate\Database\QueryException $e) {
            return Redirect::back()->withErrors(['مشکلی پیش آمده لطفا بعدا تلاش کنید.']);
        }
    }

    public function delete($id)
    {
        $note = Note::find($id);
        $note->delete();
        return Redirect('/note');
    }
}
