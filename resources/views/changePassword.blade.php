@extends('layouts.app')
@section('content')
    <div class="panel-heading">
        <div class="panel-title">Change Password</div>
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

        <div class="row">
            <div class="col-sm-12">
                <form id="" class="form-horizontal" action="/changePassword.php" method="post" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-4">Current Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="current_password" class="form-control"
                                value="{{ old('current_password') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="new_password" class="form-control"
                                value="{{ old('new_password') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="new_password_confirmation" class="form-control"
                                value="{{ old('new_password_confirmation') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 controls">
                            <a class="btn btn-default" href="/">Cancel</a>
                            <input type="submit" name="submit" class="btn btn-success" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
