@extends('layouts.app-admin')
@section('content')
    <div class="panel-heading">
        <div class="panel-title">User</div>
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
        @if (session('success'))
            <div class="alert alert-success" id="success-message">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 5000);
            </script>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <form id="" class="form-horizontal" action="/user_submit.php" method="post" role="form">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-4">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="user_email" value="<?php echo (old('user_email') !== null ? old('user_email') : isset($datas->user_email)) ? $datas->user_email : ''; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" value="<?php echo (old('name') !== null ? old('name') : isset($datas->name)) ? $datas->name : ''; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4">Username</label>
                        <div class="col-sm-8">
                            <input type="text" name="username" value="<?php echo (old('username') !== null ? old('username') : isset($datas->username)) ? $datas->username : ''; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4">Mobile</label>
                        <div class="col-sm-8">
                            <input type="text" name="user_mobile" value="<?php echo (old('user_mobile') !== null ? old('user_mobile') : isset($datas->user_mobile)) ? $datas->user_mobile : ''; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="user_password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="user_id" class="form-control" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                        <label class="col-sm-4">Type</label>
                        <div class="col-sm-8">
                            <select name="type" id="" class="form-control">
                                <option value="">Please choose</option>
                                @php
                                    $query = $datas->typeUser;
                                @endphp

                                @foreach ($query as $data)
                                    <option value="<?php echo $data; ?>" <?php echo (old('type') !== null ? old('type') : isset($datas->type) && $datas->type == $data) ? 'selected' : ''; ?>>
                                        <?php echo $data; ?>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12 controls">
                            <a class="btn btn-default" href="/user.php">Cancel</a>
                            <input type="submit" name="submit" class="btn btn-success" value="<?php echo isset($datas->type) ? 'Update' : 'Create'; ?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
