@extends('index.base')

@section('header')
    <!-- Bootstrap core CSS     -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/assets/css/demo.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>@endsection

@section('title','ویرایش پست')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">ویرایش پست</h4>
                        </div>
                        <div class="content">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="post" action="/post/{{$post->id}}/update" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">

                                        <div class="row">

                                            {{csrf_field()}}
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>عنوان</label>
                                                    <input type="text" class="form-control" name="subject"
                                                           value="{{$post->subject}}" required placeholder="subject">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>دسته</label>
                                                    <select class="form-control" name="category">
                                                        <option selected value="@if($post->category_id==-1)-1 @else {{$post->category->id}} @endif">@if($post->category_id==-1)مصاحبه @else {{$post->category->name}} @endif</option>
                                                        @foreach($category as $catname)
                                                            <option value="{{$catname->id}}">{{$catname->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>متن</label>
                                                    <textarea rows="11" class="form-control" required name="text"
                                                              placeholder="your text here">{{$post->text}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right">ثبت تغییرات
                                        <div class="clearfix"></div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <img class="btn image" src="/file/post/{{$post->image_name}}"
                                                         width="100%" height="100%">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>عکس جایگزین</label>
                                                    <input class="form-control" type="file" name="image">
                                                    <span class="label label-warning">عکس شما باید در اندازه (عرض :500 و ارتفاع :400) باشد.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('script')
    <!--   Core JS Files   -->
    <script src="/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="/assets/js/bootstrap-checkbox-radio-switch.js"></script>

    <!--  Charts Plugin -->
    <script src="/assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="/assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="/assets/js/light-bootstrap-dashboard.js"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="/assets/js/demo.js"></script>
@endsection