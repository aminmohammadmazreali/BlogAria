@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">فرم ورود</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">


                            <div class="col-md-6">
                                <input id="email" type="email" style="margin-right: -150px" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="email" class="col-md-4 control-label">آدرس ایمیل</label>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">


                            <div class="col-md-6">
                                <input id="password" type="password" style="margin-right: -150px" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="password" class="col-md-4 control-label">رمز عبور</label>
                        </div>



                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" style="margin-right: 225px">
                                    ورود
                                </button>

                                <a class="btn btn-link hidden" style="margin-right: 160px" href="{{ route('password.request') }}">
                                    رمز عبور خود را فراموش کرده اید؟
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
