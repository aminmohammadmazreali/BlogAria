<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width"/>
    <title>دکتر الهام فخاری -@yield('title')</title>

    <meta name="description" content="Download free amazing responsive Fashion Blog template."/>
    <meta name="keywords" content="free, responsive, blog, fashion, web site, template"/>
    <link rel="stylesheet" href="/css/components.css">
    <link rel="stylesheet" href="/css/responsee.css">
    <link rel="stylesheet" href="/css/amin.css">

    <!-- CUSTOM STYLE -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/template-style.css">
    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/modernizr.js"></script>
    <script type="text/javascript" src="/js/responsee.js"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
        .wrapper {
            padding: 20px;
            background: #eaeaea;
            max-width: 400px;
            margin: 50px auto;
        }

        .demo-2 {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 300px;

        }

        .demo-3 {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-height: 500px;

        }
    </style>

    @yield('head')

</head>
<body class="size-1140">
<!-- TOP NAV WITH LOGO -->
<header class="margin-bottom">
    <div class="line">
        <nav>
            <div class="top-nav">
                <p class="nav-text"></p>
                <a class="logo" href="/">
                    دکتر<span>الهام فخاری</span>
                </a>
                <h1>عضو شورای اسلامی شهر تهران ، ری و تجریش</h1>
                <ul class="top-ul right">
                    <li>
                        <a href="/news">اخبار</a>
                    </li>
                    <li>
                        <a href="/biography">بیوگرافی</a>
                    </li>
                    <li>
                        <a href="/allnote">یادداشت ها</a>
                    </li>
                    <li>
                        <a href="/interview">مصاحبه</a>
                    </li>
                    <li>
                        <a href="/allgallery">گالری</a>
                    </li>

                    <li>
                        <a href="/contact">ارتباط باما</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- MAIN SECTION -->

<section id="@yield('sec')-section" class="line">
    <div class="margin">

    @yield('content')

    <!-- SIDEBAR -->
        <div class="s-12 l-3">

            @yield('sidebar')
            <aside>
                <!-- AD REGION -->
                <div class="advertising margin-bottom">
                    <img src="/img/banner.jpg" alt="ad banner">
                </div>
            </aside>
            <aside>

                @foreach($galery as $item)
                <!-- NEWS 1 -->
                <a href="/allgallery/{{$item->id}}"><img src="/file/galery/head/{{$item->image_name}}"></a>

                @endforeach

                <!-- AD REGION -->

            </aside>
        </div>
    </div>
</section>
<!-- FOOTER -->
<div class="line">
    <footer>
        <div class="s-12 l-8">
            <p>
                تمامی حقوق این سایت برای دکتر الهام فخاری محفوظ می باشد<br>

            </p>
        </div>

    </footer>
</div>

@yield('script')
</body>

</html>
