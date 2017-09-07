<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/admin',function ()
{
    return redirect('/login');
});



//front

Route::get('/','FrontController@news');
Route::get('/news','FrontController@news');
Route::get('/news/{id}','FrontController@newsone');
Route::get('/biography','FrontController@bio');
Route::get('/interview','FrontController@interview');
Route::get('/allnote','FrontController@note');
Route::get('/allnote/{id}','FrontController@noteone');
Route::get('/allgallery','FrontController@gallery');
Route::get('/allgallery/{id}','FrontController@galleryone');
Route::get('/contact','FrontController@contact');
Route::post('/contactstore','FrontController@contactstore');


//comment
Route::post('/storecomment/{id}','FrontController@storecomment');


Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard','HomeController@dashboard');

    //post
    Route::get('/post/new','PostController@new');
    Route::get('/post','PostController@showposts');
    Route::post('/post/store','PostController@store');
    Route::get('/post/{id}/edit','PostController@edit');
    Route::post('/post/{id}/update','PostController@update');
    Route::get('/post/{id}/delete','PostController@delete');
     //comment
     Route::get('/comment','PostController@showcomment');
     Route::get('/comment/{id}/enable','PostController@enablecomment');
     Route::get('/comment/{id}/delete','PostController@deletecomment');

//category
    Route::get('/category','CategoryController@show');
    Route::post('/category/store','CategoryController@store');
    Route::post('/category/{id}/update','CategoryController@update');
    Route::get('/category/{id}/delete','CategoryController@delete');

//message
    Route::get('/messages','MessageController@show');
    Route::get('/messages/{id}','MessageController@read');
    Route::get('/messages/{id}/delete','MessageController@delete');

//note
    Route::get('/note','NoteController@shownote');
    Route::get('/note/new','NoteController@newnote');
    Route::post('/note/store','NoteController@store');
    Route::get('/note/{id}/edit','NoteController@edit');
    Route::post('/note/{id}/update','NoteController@update');
    Route::get('/note/{id}/delete','NoteController@delete');


//gallery
    Route::get('/gallery','GalleryController@showgalery');
    Route::get('/gallery/new','GalleryController@newgalery');
    Route::post('/gallery/store','GalleryController@store');
    Route::get('/gallery/{id}/edit','GalleryController@edit');
    Route::post('/gallery/{id}/update','GalleryController@update');
    Route::get('/gallery/{id}/delete','GalleryController@delete');

//images
    Route::get('/images/{id}/delete','GalleryController@deleteimage');
});


Route::get('/test',function (){



    $message=\App\Message::find(1);
    $dev= str($message->time);
    echo $message->time ." ".time();

    $date=jdate(date($dev))->format('%B');

    //$date = \Morilog\Jalali\Facades\jDate::forge(time());
    //$date = jdate(time())->format('date');
    return $date;
});


