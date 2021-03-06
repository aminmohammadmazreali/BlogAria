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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>
@endsection
@section('title','دسته بندی ها')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">دسته جدید</h4>
                        </div>
                        <div class="content">
                            <form id="newcategoryfrm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>نام</label>
                                            <input type="text" id="nameactegory" class="form-control"
                                                   name="namecategory" placeholder="نام دسته را وارد کنید...">
                                            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-info btn-fill pull-right">ذخیره دسته</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">لیست دسته ها</h4>
                            <p class="category"></p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table dir="ltr" class="table table-hover table-striped">
                                <thead>
                                <th>کد دسته</th>
                                <th>نام</th>
                                <th>تعداد پست ها</th>
                                <th>عملیات</th>
                                </thead>
                                <tbody>
                                @foreach($category as $name)
                                    <tr>
                                        <td>{{$name->id}}</td>
                                        <td>{{$name->name}}</td>
                                        <td>{{count($name->post)}}</td>
                                        <td>
                                            <a rel="tooltip" title=""
                                               onclick="document.getElementById('edit{{$name->id}}').style.display='block'"
                                               class="btn btn-warning btn-simple btn-xs" data-original-title="ویرایش">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <delete id="{{$name->id}}"  rel="tooltip" title=""
                                                    class="btn btn-danger btn-simple btn-xs" data-original-title="حذف">
                                                <i class="fa fa-times"></i>
                                            </delete>
                                        </td>
                                    </tr>
                                    <div id="edit{{$name->id}}" class="w3-modal">
                                        <div class="w3-modal-content">
                                            <div class="w3-container">
                                                <span onclick="document.getElementById('edit{{$name->id}}').style.display='none'"
                                                      class="w3-button w3-display-topright">&times;</span>
                                                <br>
                                                <form method="post" action="/category/{{$name->id}}/update">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>نام</label>
                                                                <input type="text" id="nameactegory"
                                                                       class="form-control"
                                                                       name="namecategory" value="{{$name->name}}">
                                                                <input type="hidden" name="_token" id="token"
                                                                       value="{{csrf_token()}}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a type="submit" class="btn btn-info btn-fill pull-right">ذخیره</a>
                                                    <div class="clearfix"></div>
                                                </form>
                                                <br>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                    {{$category->links()}}
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


        $('#newcategoryfrm').submit(function () {
            var formData = {
                namecategory: $('#nameactegory').val(),
                _token: $('#token').val()
            };

            $.ajax({

                type: 'post',
                url: '/category/store',
                data: formData,
                success: function (data) {

                    console.log(data)
                },
                error: function (data) {
                    console.log("danger")

                }
            });
        });


        $("delete").click(function () {
            //alert(this.id);
//            alert($(this).attr('id'));


            var amin = $(this).attr('id');
            swal({
                title: "پاک شود؟",
                text: "در صورت حذف کردن این دسته تمامی پست های داخل این دسته نیز حذف می شود!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#039BE5",
                cancelVuttonColor: "#E50814",
                confirmButtonText: "موافقم",
                cancelButtonText: "خیر",
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    type: 'get',
                    url: '/category/' + amin + '/delete',
                    success: function (data) {

                        swal({
                            title: "پاک شد!",
                            text: "المنت مورد نظر با موفقیت پاک شد.",
                            type: "success",
                            confirmButtonText: "تایید",
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