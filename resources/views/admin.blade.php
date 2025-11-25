@extends('layouts.app')
@section('content')
    <div class="panel-heading">
        <div class="panel-title">
            Login dan Masuk Ke Sistem
        </div>
        <div style="padding-top:30px" class="panel-body">
            @if ($errors->any())
                <div id="login-alert" class="alert alert-danger col-sm-12">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.php') }}" method="POST">
                @csrf
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="login-username" type="text" class="form-control" name="username"
                        value="{{ old('username') }}" placeholder="username">

                </div>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                </div>
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                        <input type="submit" name="login" class="btn btn-success" value="Login" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
