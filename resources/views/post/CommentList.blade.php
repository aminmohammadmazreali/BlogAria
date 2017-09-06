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
              <table dir="ltr" class="table table-hover table-striped">
                <thead>
                <th>کد </th>
                <th>نام ارسال کننده</th>
                <th>ایمیل</th>
                <th>وضعیت</th>
                <th>پست</th>
                <th>عملیات</th>

                </thead>
                <tbody>
                @foreach($comment as $name)
                  <tr>
                    <td>{{$name->id}}</td>
                    <td>{{$name->user_name}}</td>
                    <td>{{$name->user_email}}</td>
                    <td>@if($name->status==0)<span class="label label-danger">تایید نشده</span> @else <span class="label label-success">تایید شده</span> @endif</td>
                    <td><a href="/news/{{$name->post_id}}"> {{$name->post_id}}</a></td>
                    <td>
                      {{--<a href="/comment/{{$name->id}}/delete" >--}}
                        {{--<i class="fa fa-times"></i>--}}
                      {{--</a>--}}
                      {{--<a href="">--}}
                        {{--<i class="fa fa-eye"></i>--}}
                      {{--</a>--}}
                      {{--<a href="/comment/{{$name->id}}/enable">--}}
                        {{--<i class="fa fa-thumbs-o-up"></i>--}}
                      {{--</a>--}}

                      <delete id="{{$name->id}}"  rel="tooltip" title=""
                              class="btn btn-danger btn-simple btn-xs" data-original-title="حذف" >
                        <i class="fa fa-times"></i>
                      </delete>
                      <see id="{{$name->text}}" rel="tooltip" title=""
                           class="btn btn-info btn-simple btn-xs" data-original-title="مشاهده">
                        <i class="fa fa-eye"></i>
                      </see>
                      <enable id="{{$name->id}}"  rel="tooltip" title=""
                              class="btn btn-success btn-simple btn-xs" data-original-title="تایید">
                        <i class="fa fa-thumbs-o-up"></i>
                      </enable>

                      </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>

          </div>
          {{$comment->links()}}
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
      $("delete").click(function () {
          //alert(this.id);
//            alert($(this).attr('id'));


          var amin = $(this).attr('id');
          swal({
              title: "حذف شود؟",
              text: "مطمئن هستید می خواهید این نظر را حذف  کنید ؟ ",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#039BE5",
              cancelButtonColor: "#E50814",
              confirmButtonText: "موافقم!",
              cancelButtonText: "خیر!",
              closeOnConfirm: false
          }, function () {

              $.ajax({
                  type: 'get',
                  url: '/comment/' + amin + '/delete',
                  success: function (data) {

                      swal({
                          title: "پاک شد!",
                          text: "نظر مورد نظر با موفقیت پاک شد.",
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

      $("see").click(function () {
          //alert(this.id);
//            alert($(this).attr('id'));


          var amin = $(this).attr('id');
          swal({
              title: '',
              text: amin,
              type: '',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'بستن'
          })

      });

      $("enable").click(function () {
          //alert(this.id);
//            alert($(this).attr('id'));


          var amin = $(this).attr('id');
          swal({
              title: "تایید شود؟",
              text: "مطمئن هستید می خواهید این نظر را تایید کنید ؟ ",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#039BE5",
              cancelButtonColor: "#E50814",
              confirmButtonText: "بله",
              cancelButtonText: "خیر",
              closeOnConfirm: false
          }, function () {

              $.ajax({
                  type: 'get',
                  url: '/comment/' + amin + '/enable',
                  success: function (data) {

                      swal({
                          title: "تایید شد!",
                          text: "نظر مورد نظر با موفقیت تایید شد.",
                          type: "success",
                          confirmButtonColor: "#039BE5"
                      }, function () {
                          location.reload();
                      });


                  },
                  error: function (data) {

                      swal({
                          title: "تایید نشد!",
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