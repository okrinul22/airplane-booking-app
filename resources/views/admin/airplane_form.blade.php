@extends('layouts.app-admin')
@section('content')
    <div class="panel-heading">
        <div class="panel-title">Air Plane</div>
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
                <form id="" class="form-horizontal" action="/airplane_submit.php" method="post" role="form">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-4">Air Plane Name</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="air_plane_id" class="form-control" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                            <input type="text" name="air_plane_name" value="<?php echo (old('air_plane_name') !== null ? old('air_plane_name') : isset($datas->air_plane_name)) ? $datas->air_plane_name : ''; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 controls">
                            <a class="btn btn-default" href="/airplane.php">Cancel</a>
                            <input type="submit" name="submit" class="btn btn-success" value="<?php echo isset($datas) ? 'Update' : 'Create'; ?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
