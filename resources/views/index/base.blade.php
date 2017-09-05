<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>دکتر الهام فخاری - @yield('title')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <link href="/assets/css/amin.css" rel="stylesheet"/>
    @yield('header')


</head>
<body dir="rtl">
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="/assets/img/sidebar-5.jpg">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/" class="simple-text">
                    دکتر الهام فخاری
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="/dashboard">
                        <i class="pe-7s-graph"></i>
                        <p>داشبورد</p>
                    </a>

                <li >
                    <a href="/post">
                        <i class="pe-7s-note"></i>
                        <p>پست</p>
                    </a>
                </li>
                <li>
                    <a href="/note">
                        <i class="pe-7s-note2"></i>
                        <p>یادداشت</p>
                    </a>
                </li>
                <li>
                    <a href="/category">
                        <i class="pe-7s-albums"></i>
                        <p>دسته بندی</p>
                    </a>
                </li>
                <li>
                    <a href="/gallery">
                        <i class="pe-7s-photo-gallery"></i>
                        <p>گالری</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid" dir="rtl">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">کاربر</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">

                        <li class="dropdown">
                            <a href="/messages">
                                <i class="fa fa-comment-o"></i>

                                <span class="notification hidden-sm hidden-xs">{{$countmessages}}</span>

                            </a>

                        </li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="">
                                <p>پروفایل</p>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <p>خروج</p>
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

</div>
@yield('script')
</body>

</html>
