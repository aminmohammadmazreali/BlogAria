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

@section('title','ویرایش گالری')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">ویرایش گالری <b class="text-success">{{$galery->name}}</b></h4>
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
                            <form method="post" action="/gallery/{{$galery->id}}/update" enctype="multipart/form-data">
                                <div class="row">

                                    {{csrf_field()}}
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>عکس های گالری (قابلیت انتخاب چندتایی)</label>
                                                        <input class="form-control" type="file" name="images[]" multiple>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>عکس های داخل گالری : </p>
                                            <span class="label label-danger">برای حذف عکس ها روی آن ها کلیک کنید</span>
                                        </div>
                                        <div class="col-md-12">
                                            @foreach($galery->images as $item)

                                                <div class="form-group">
                                                    <imagealert id="{{$item->id}}"><img
                                                                class=""
                                                                src="/file/galery/{{$item->image_name}}"
                                                                width="100%"></imagealert>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>نام</label>
                                                    <input type="text" class="form-control" name="name"
                                                           value="{{$galery->name}}" required placeholder="name">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <img class="btn"
                                                     src="/file/galery/head/{{$galery->image_name}}"
                                                     width="100%    ">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>عکس جایگزین</label>
                                                <input class="form-control" type="file" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-info btn-fill pull-right">ذخیره تغییرات
                                </button>
                                <div class="clearfix"></div>
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

    <script>
        $("imagealert").click(function () {
            //alert(this.id);
//            alert($(this).attr('id'));


            var amin = $(this).attr('id');
            swal({
                title: "پاک شود؟",
                text: "مطمئن هستید از پاک کردن این عکس؟",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#039BE5",
                cancelVuttonColor: "#E50814",
                confirmButtonText: "بله",
                cancelButtonText: "خیر",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    type: 'get',
                    url: '/images/' + amin + '/delete',
                    success: function (data) {

                        swal({
                            title: "پاک شد!",
                            text: "عکس مورد نظر با موفقیت پاک شد.",
                            type: "success",
                            confirmButtonColor: "#039BE5"
                        }, function () {
                            location.reload();
                        });


                    },
                    error: function (data) {

                        swal({
                            title: "پاک نشد!",
                            text: "عملیات با مشکلی مواجه شده است لطفا بعدا تلاش کنید.",
                            type: "error",
                            confirmButtonColor: "#039BE5"
                        });
                    }

                });


            });

        });
    </script>
@endsection