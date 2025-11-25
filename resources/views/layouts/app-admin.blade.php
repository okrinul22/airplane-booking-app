<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Plane Ticket Admin</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="style.css">
</head>

<body>
    <div class="container my-4">
        <div class="col-md-12">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/booking.php">Travel</a>
                    </div>
                    <ul class="nav navbar-nav">

                        <li class="{{ Request::is('booking.php') ? 'active' : '' }}"><a href="/booking.php">Booking</a>
                        </li>
                        <li class="{{ Request::is('airplane.php') ? 'active' : '' }}"><a href="/airplane.php">Air
                                Plane</a>
                        </li>
                        <li class="{{ Request::is('schedule.php') ? 'active' : '' }}"><a href="/schedule.php">Schedule
                                Air Plane</a>
                        </li>
                        <li class="{{ Request::is('user.php') ? 'active' : '' }}"><a href="/user.php">User</a>
                        </li>
                        <li class="{{ Request::is('changePassword.php') ? 'active' : '' }}"><a
                                href="/changePassword.php">Change Password</a>
                        </li>
                        <li><a href="/logout.php">Logout</a>
                        </li>
                        <li><a href="#" style="color: white;">Login By {{ Auth::user()->name }}</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="panel panel-default">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
