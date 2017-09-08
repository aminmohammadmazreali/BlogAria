@extends('index.front')

@section('title','بیوگرافی')

@section('sec','home')


@section('content')

    <!-- ARTICLES -->
    <div class="s-12 l-9">

        <!-- ARTICLE 1 --><p>گالری ها</p>
        <article class="line">
            <!-- image -->
            @foreach($news as $item)
                <div class="gallery">
                    <div class="all">
                        <div class="s-6 l-12">
                        <a href="/allgallery/{{$item->id}}">
                            <img src="/file/galery/head/{{$item->image_name}}" alt="Avatar" class="image">
                            <div class="overlay">
                                <div class="text">مشاهده </div>

                            </div>
                            <div class="desc"><aa style="color: white">{{$item->name}}</aa></div>
                        </a>
                        </div>
                    </div>
                </div>

            @endforeach



        </article>


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
