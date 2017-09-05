<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show()
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);

        $messages=Message::paginate(10);
        return view('message.MessageList')->with(['message'=>$messages,'countmessages'=>$countmessages]);
    }

    public function read($id)
    {
        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);

        $message=Message::find($id);
        $message->status=1;
        $message->update();
        return view('message.ShowMessage')->with(['message'=>$message,'countmessages'=>$countmessages]);
    }

    public function delete($id)
    {
        $message=Message::find($id);
        $message->delete();
        return redirect('/messages');
    }
}
