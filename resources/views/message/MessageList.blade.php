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
    <link href="/assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>
@endsection
@section('title','پیام ها')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">

                    <div class="card">
                        <div class="header">
                            <h4 class="title">لیست پیام ها</h4>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped" dir="ltr">
                                <thead>
                                <th>کد پیام</th>
                                <th>نام ارسال کننده</th>
                                <th>ایمیل</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>

                                </thead>
                                <tbody>
                                @foreach($message as $name)
                                    <tr>
                                        <td>{{$name->id}}</td>
                                        <td>{{$name->name}}</td>
                                        <td>{{$name->email}}</td>
                                        <td>@if($name->status==0)<span class="label label-danger">دیده نشده</span> @else
                                                <span class="label label-success">دیده شده</span> @endif</td>
                                        <td>
                                            <button id="{{$name->id}}" type="button" rel="tooltip" title="" class="btn btn-danger btn-simple btn-xs" data-original-title="حذف">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <a href="/messages/{{$name->id}}" type="button" rel="tooltip" title="" class="btn btn-info btn-simple btn-xs" data-original-title="مشاهده">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    {{$message->links()}}
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
        $("button").click(function () {
            //alert(this.id);
//            alert($(this).attr('id'));


            var amin = $(this).attr('id');
            swal({
                title: "پاک شود؟",
                text: "در صورت حذف کردن، این المنت قابل بازیابی نمیباشد!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#039BE5",
                cancelVuttonColor: "#E50814",
                confirmButtonText: "بله!",
                cancelButtonText: "خیر!",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    type: 'get',
                    url: '/messages/' + amin + '/delete',
                    success: function (data) {

                        swal({
                            title: "پاک شد!",
                            text: "المنت مورد نظر با موفقیت پاک شد.",
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