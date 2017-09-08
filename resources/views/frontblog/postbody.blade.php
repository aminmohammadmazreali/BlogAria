@extends('index.front')

@section('title','اخبار')
@section('sec','article')
@section('content')

    <div class="s-12 l-9">
        <!-- ARTICLE 1 -->
        <article class="margin-bottom">
            <div class="post-1 line">
                <!-- image -->
                <div class="s-12 l-11 post-image">
                    <img src="/file/post/{{$news->image_name}}">
                </div>
                <!-- date -->
                <div class="s-12 l-1 post-date">
                    <p class="date">07</p>
                    <p class="month">مهر</p>
                </div>
            </div>
            <!-- text -->
            <div class="post-text">
                <h1>{{$news->subject}}</h1>
                <p>
                    {{$news->text}}
                </p>

            </div>
        </article>
        <!-- AD REGION -->
        <div class="line">
            <div class="advertising horizontal">
                <h2>نظرات({{count($news->comment)}})</h2>

            </div>
            @foreach($news->comment as $comment)
                @if($comment->status==1)
            <div class="advertising horizontal" >
                <p style="border-style: solid; border-width: medium;">
                <p>ارسال کننده : <b>{{$comment->user_name}}</b></p>
                <blockquote></blockquote>
                <h6 style="margin-right: 50px;">" {{$comment->text}} "</h6>

            </div>
                @endif
            @endforeach


            <div class="advertising horizontal">

                <h4>نظرتان در مورد این خبر چیست؟</h4><br>
                <form class="customform" action="/storecomment/{{$news->id}}" method="post">
                    <div class="s-12"><input name="email" placeholder="ایمیل شما" type="email"/></div>
                    <div class="s-12"><input name="name" placeholder="اسم شما" type="text"/></div>
                    <div class="s-12"><textarea placeholder="متن نظر شما" name="text" rows="5"></textarea>
                    </div>
                    <button type="submit">ارسال</button>
                    {{csrf_field()}}
                </form>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </h4>
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection
@section('sidebar')
    @if(!is_null($note))
    <aside>
        <!-- NEWS 1 -->
        <img src="/file/note/{{$note->image_name}}">
        <div class="aside-block margin-bottom">
            <a href="/allnote/{{$note->id}}"><h3>{{$note->subject}}</h3></a>

            <p class="demo-3">
                {{$note->text}}
            </p>

        </div>


    </aside>
    @endif
@endsection