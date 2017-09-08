@extends('index.front')

@section('title','اخبار')
@section('sec','article')
@section('content')



    <!-- ARTICLES -->
    <div class="s-12 l-9">
        <p>مصاحبه ها</p>
        <!-- ARTICLE 1 -->
        @foreach($news as $item)

            <article class="margin-bottom">
                <div class="post-4 line">
                    <!-- image -->
                    <div class="s-12 l-11 post-image">
                        <a href="/news/{{$item->id}}"><img src="file/post/{{$item->image_name}}"></a>
                    </div>
                    <!-- date -->
                    <div class="s-12 l-1 post-date">
                        <p class="date">07</p>
                        <p class="month">مهر</p>
                    </div>
                </div>
                <!-- text -->
                <div class="post-text">
                    <a href="/news/{{$item->id}}">
                        <h2>{{$item->subject}}</h2>
                    </a>
                    <p class="demo-3">
                        {{$item->text}}
                    </p>
                    <a class="continue-reading" href="/news/{{$item->id}}">ادامه مصاحبه</a>
                </div>
            </article>

        @endforeach


    </div>







@endsection

@section('sidebar')
    @if(!is_null($note))
    <aside>
        <!-- NEWS 1 -->
        <img src="/file/note/{{$note->image_name}}">
        <div class="aside-block margin-bottom">
            <a href="/news/{{$note->id}}">  <h3>{{$note->subject}}</h3> </a>

            <p class="demo-3">
                {{$note->text}}
            </p>

        </div>


    </aside>
    @endif
@endsection