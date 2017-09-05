@extends('index.front')

@section('title','بیوگرافی')

@section('sec','home')


@section('content')

    <!-- ARTICLES -->
    <div class="s-12 l-9">

        <!-- ARTICLE 1 -->
        <article class="post-1 line">
            <!-- image -->
            @foreach($news as $item)
                <div class="s-12 l-6 post-image post-text">
                    <a href="/allgallery/{{$item->id}}">
                        <img src="/file/galery/head/{{$item->image_name}}">
                    </a>
                </div>
            @endforeach


        </article>


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
