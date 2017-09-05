@extends('index.front')

@section('title','اخبار')
@section('sec','home')
@section('content')

    <div class="s-12 l-9">


        @foreach($news as $item)
            <!-- ARTICLE 1 -->
                <article class="post-2 line">
                    <!-- image -->
                    <div class="s-12 l-6 post-image">
                        <a href="/news/{{$item->id}}">
                            <img src="/file/post/{{$item->image_name}}">
                        </a>
                    </div>
                    <!-- text -->
                    <div class="s-12 l-5 post-text">
                        <a href="/news/{{$item->id}}">
                            <h2 >{{$item->subject}}</h2>
                        </a>

                        <p class="demo-2">
                            {{$item->text}}
                        </p>
                    </div>
                    <!-- date -->
                    <div class="s-12 l-1 post-date">
                        <p class="date">12</p>
                        <p class="month">مهر</p>
                    </div>

                </article>

            <hr>
        @endforeach


{{$news->links('vendor.pagination.bootstrap-4')}}
    </div>

@endsection
@section('sidebar')
    <aside>
        <!-- NEWS 1 -->
        <img src="/file/note/{{$note->image_name}}">
        <div class="aside-block margin-bottom">
            <a href="/allnote/{{$note->id}}">  <h3>{{$note->subject}}</h3> </a>

            <p class="demo-3">
                {{$note->text}}
            </p>

        </div>


    </aside>
@endsection