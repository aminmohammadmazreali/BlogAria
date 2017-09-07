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

@section('title','لیست یادداشت ها')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="/note/new"><span class="label label-info">یادداشت جدید</span></a>
        </div>
        <div class="col-md-12">

          <div class="card">
            <div class="header">
              <h4 class="title">لیست یاداداشت ها</h4>

            </div>
            <div class="content table-responsive table-full-width">
              <table dir="ltr" class="table table-hover table-striped">
                <thead>
                <th>کد </th>
                <th>عنوان</th>
                <th>تاریخ ایجاد</th>
                <th>عملیات</th>
                </thead>
                <tbody>
                @foreach($note as $name)
                  <tr>
                    <td>{{$name->id}}</td>
                    <td>{{$name->subject}}</td>
                      <td>{{jdate(time())->format('%d %B %Y')}}</td>
                    <td>
                      <a  href="/note/{{$name->id}}/edit" rel="tooltip" title=""
                              class="btn btn-warning btn-simple btn-xs" data-original-title="ویرایش">
                        <i class="fa fa-edit"></i>
                      </a>
                      <button id="{{$name->id}}" rel="tooltip" title=""
                              class="btn btn-danger btn-simple btn-xs" data-original-title="حذف">
                        <i class="fa fa-times"></i>
                      </button>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>

          </div>
          {{$note->links()}}
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
              text: "مطمئن هستید از پاک کردن این یادداشت ؟ ",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#039BE5",
              cancelVuttonColor: "#E50814",
              confirmButtonText: "موافقم!",
              cancelButtonText: "خیر!",
              closeOnConfirm: false
          }, function () {

              $.ajax({
                  type: 'get',
                  url: '/note/' + amin + '/delete',
                  success: function (data) {

                      swal({
                          title: "پاک شد!",
                          text: "یادداشت مورد نظر با موفقیت پاک شد.",
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