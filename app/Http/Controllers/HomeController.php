<?php

namespace App\Http\Controllers;

use App\Galery;
use App\Message;
use App\Note;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $post=Post::all();
        $note=Note::all();
        $gallary=Galery::all();

        $cmessages=Message::all()->where('status',0);
        $countmessages=count($cmessages);

        return view('Dashboard')->with(['post'=>$post,'note'=>$note,'gallary'=>$gallary,'countmessages'=>$countmessages]);

    }

}
