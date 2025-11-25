@extends('layouts.app')
@section('content')
    <style>
        .active {
            color: black !important;
        }

        .navbar-inverse .navbar-nav>li>a:hover,
        .navbar-inverse .navbar-nav>li>a:focus {
            color: blue !important;
            background-color: transparent;
            /* Add this to remove the default background color on hover */
        }
    </style>
    <div class="panel-heading">
        <div class="panel-title">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <nav class="navbar navbar-inverse"
                            style="background-color: unset !important;border-color:unset !important;border:unset !important;margin-bottom: 0px">
                            <div class="container-fluid">
                                <div class="navbar-header">
                                    <a class="navbar-brand active" href="/"> Air
                                        Plane Ticket</a>
                                </div>
                                <ul class="nav navbar-nav">
                                    @if (Auth::check())
                                        <li class="{{ Request::is('history.php') ? 'active' : '' }}"><a
                                                href="/history.php">History</a>
                                        </li>
                                        <li class="{{ Request::is('changePassword.php') ? 'active' : '' }}"><a
                                                href="changePassword.php">Change Password</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                    @if (!Auth::check())
                        <div class="pull-right">
                            <a href="/register.php" class="btn btn-default">Register</a>
                            <a href="/login.php" class="btn btn-primary">Login</a>
                        </div>
                    @else
                        <div class="pull-right">
                            <span class="label label-danger">{{ Auth::user()->name }}</span>
                            {{-- <a href="/changePassword.php" class="btn btn-warning">Change Password</a> --}}
                            <a href="/logout.php" class="btn btn-primary">Logout</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div style="padding-top:30px" class="panel-body">
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
        <br />
        <div class="row">
            <div class="col-md-12">
                <div class="thumbnail" style="padding: 15px">
                    <h4>Filter</h4>
                    <div class="row">
                        <form action="/" method="get" style="display: inline;">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <input type="text" name="airline" class="form-control"
                                        placeholder="Search for Airline"
                                        value="{{ isset($_GET['airline']) ? $_GET['airline'] : '' }}" />
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <input type="date" name="schedule" class="form-control" placeholder="Date"
                                        value="{{ isset($_GET['schedule']) ? $_GET['schedule'] : '' }}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @foreach ($datas as $data)
                    @php
                        $urlRedirect = !Auth::check() ? '/register.php?redirect=' . '/booking_customer_form.php?id=' . $data->sch_air_plane_id : '/booking_customer_form.php?id=' . $data->sch_air_plane_id;
                    @endphp

                    <a href="{{ $urlRedirect }}">
                        <div class="well">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="pull-left"
                                        style="background-color: #2b19e56b;
                                        display: flex;
                                        justify-content: center;
                                        flex-direction: column;
                                        align-items: center;
                                        height: 100px;
                                        padding: 20px;
                                        border-radius: 10px;
                                        padding-top: 30px;">
                                        <p class="" style="color:white">
                                            Airline :
                                            {{ $data->air_plane->air_plane_name }}
                                        </p>

                                    </div>
                                    <div class="pull-right"
                                        style="background-color: #41a37d6b;
                                        display: flex;
                                        justify-content: center;
                                        flex-direction: column;
                                        align-items: center;
                                        height: 100px;
                                        padding: 20px;
                                        border-radius: 10px;
                                        padding-top: 30px;">
                                        <p style="color:#761c1c">
                                            Schedule : {{ $data->schedule }}
                                        </p>
                                        <p style="color:#626372">
                                            Price : {{ rupiah($data->sch_price) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    <ul class="pagination">
                        @if ($datas->previousPageUrl())
                            <li><a href="{{ $datas->previousPageUrl() }}" rel="prev">&laquo;
                                    Previous</a></li>
                        @endif

                        @for ($i = 1; $i <= $datas->lastPage(); $i++)
                            <li class="{{ $datas->currentPage() == $i ? 'active' : '' }}">
                                <a href="{{ $datas->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($datas->nextPageUrl())
                            <li><a href="{{ $datas->nextPageUrl() }}" rel="next">Next &raquo;</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
