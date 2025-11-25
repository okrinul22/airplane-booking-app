@extends('layouts.app')
@section('content')
    <div class="panel-heading">
        <div class="panel-title">Customer Register</div>
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
                <form id="" class="form-horizontal"
                    action="/customer/register.php{{ '?redirect=' . $datas['redirect'] }}" method="post" role="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-4">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="user_email" class="form-control" value="{{ old('user_email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4">Mobile</label>
                        <div class="col-sm-8">
                            <input type="text" name="user_mobile" class="form-control" value="{{ old('user_mobile') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="user_password" class="form-control"
                                value="{{ old('user_password') }}">
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
