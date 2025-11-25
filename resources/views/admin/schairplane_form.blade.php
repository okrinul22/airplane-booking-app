@extends('layouts.app-admin')
@section('content')
<div class="panel-heading">
    <div class="panel-title">Schedule</div>
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
            <form id="" class="form-horizontal" action="/schedule_submit.php" method="post" role="form">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-4">Schedule</label>
                    <div class="col-sm-8">
                        <input type="datetime-local" name="schedule" value="<?php echo (old('schedule') !== null ? old('schedule') : isset($datas->schedule)) ? $datas->schedule : ''; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" name="sch_air_plane_id" class="form-control" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                    <label class="col-sm-4">Air Plane Name</label>
                    <div class="col-sm-8">
                        <select name="air_plane_id" id="" class="form-control">
                            <option value="">Please choose</option>
                            @php
                            $query = $datas->airPlaneData;
                            @endphp

                            @foreach ($query as $data)
                            <option value="<?php echo $data['air_plane_id']; ?>" <?php echo (old('air_plane_id') !== null ? old('air_plane_id') : isset($datas->air_plane_id) && $datas->air_plane_id == $data['air_plane_id']) ? 'selected' : ''; ?>>
                                <?php echo $data['air_plane_name']; ?>
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4">Price</label>
                    <div class="col-sm-8">
                        <input type="number" name="sch_price" value="<?php echo (old('sch_price') !== null ? old('sch_price') : isset($datas->sch_price)) ? $datas->sch_price : ''; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 controls">
                        <a class="btn btn-default" href="/schedule.php">Cancel</a>
                        <input type="submit" name="submit" class="btn btn-success" value="<?php echo isset($datas->sch_price) ? 'Update' : 'Create'; ?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection