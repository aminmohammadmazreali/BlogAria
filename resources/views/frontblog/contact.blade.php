@extends('index.front')

@section('title','اخبار')
@section('sec','article')
@section('content')



    <div class="s-12 l-9">
        <!-- ARTICLE 1 -->
        <article class="margin-bottom">
            <!-- text -->
            <div class="post-text">
                <h1>ارتباط با ما</h1>
                <div class="line">
                    <div class="margin">
                        <div class="s-12 l-6">
                            <h4>برای ارتباط با ما فرم را پر کنید</h4>
                            <address>
                                <p><i class="icon-home icon"></i> آدرس دفتر </p>
                                <p><i class="icon-globe_black icon"></i>ایران.تهران</p>
                                <p><i class="icon-mail icon"></i> info@test.com</p>
                            </address>
                            <br/>
                            <h4>شبکه های اجتماعی</h4>
                            <p><i class="icon-facebook icon bg-blue"></i> <a href="#">فیسبوک</a></p>
                            <p class="margin-bottom"><i class="icon-twitter icon"></i> <a href="#">توییتر</a></p>
                        </div>
                        <div class="s-12 l-6">
                            <h4>لطفا تمامی فیلد هارا پر کنید.</h4>
                            <form class="customform" action="/contactstore" method="post">
                                <div class="s-12"><input name="email" placeholder="ایمیل شما" type="text"/></div>
                                <div class="s-12"><input name="name" placeholder="اسم شما" type="text"/></div>
                                <div class="s-12"><textarea placeholder="متن پیام شما" name="text" rows="5"></textarea>
                                </div>
                                <button type="submit">ارسال پیام</button>
                                {{csrf_field()}}
                            </form>

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <h3>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </h3>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </article>
        <!-- AD REGION -->
        <div class="line">
            <div class="advertising horizontal">
                <img src="img/banner-horizontal.jpg" alt="ad banner">
            </div>
        </div>
    </div>








@endsection

@section('sidebar')
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
@endsection