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
                    <img src="/file/post/{{$news->image_name}}" >
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
                <img src="/img/banner-horizontal.jpg" alt="ad banner">
            </div>
        </div>
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