<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>All Vehicle</title>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        .links>a {
            color: white;
            padding: 0 10px;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: .1rem;
            text-decoration: none;
            /* text-transform: uppercase; */

        }
    </style>
</head>
<?php
use Illuminate\Support\Facades\DB;
?>

<body style="background:linear-gradient(to top,#FFFFF,white)no-repeat fixed center;">
    @if(Auth::check())
    <nav class="navbar fixed-top navbar-expand-lg  navbar-dark bg-dark ">
        <a class="navbar-brand" href="{{url('/')}}" style="font-family: cursive, sans-serif; font-size:18px; color: #FDE600;">
            Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/welcome')}}">Welcome<span class="sr-only">(current)</span></a>
                </li>


            </ul>
            <div class="links">
                <a href="{{url('/insert')}}">Insert driver</a>
                <a href="{{url('/show_insert_car')}}">Insert vehicle</a>
                <a href="{{url('/show_alldrivers')}}">All drivers</a>
                <!-- <a href="#">All vehicle</a> -->
                <a href="{{url('/show_assign')}}">Assign</a>
                <a href="{{url('/choose_vehiclebydriver')}}">VehicleByDrivers</a>
                <a href="{{url('/choose_driverbyvehicle')}}">DriverByVehicle</a>
                <!-- <a href="#">Edit Car</a> -->
                <!-- <a href="#">Edit Driver</a> -->
            </div>
            &nbsp; &nbsp;
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="container">
            <div class="container mt-5 p-5 col-8">
                @if (!empty($success))
                <span class="bg-success text-light">{{$success}}</span>
                @endif
                <h4>All Vehicle</h4>
                <?php
                // dd($id_vehicle); dolazi id_vehicle uraditi sencenje reda, potrebno uraditi terny upit
                //da dohvatiomo Id_vehicle zbog opcija insert, edit i delete

                $id_vehicle = isset($id_vehicle) ? $id_vehicle : "";
                //select * from vehicle
                $allvehicle = DB::table('vehicle')->get();
                ?>
                <table class="table table-dark text-center table-sm">
                    <thead>
                        <tr>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Category</th>
                            <th>Year vehicle</th>
                            <th>Prise</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allvehicle as $p)
                        <!-- sencenje kolone u kojoj je izvrseno editovanje -->
                        @if($id_vehicle == $p->id_vehicle)
                        <tr class="bg-success">
                            @else
                        <tr>
                            @endif
                            <td>{{$p->brand}}</td>
                            <td>{{$p->model}}</td>
                            <td>{{$p->category}}</td>
                            <td>{{$p->year_vehicle}}</td>
                            <td>{{$p->price}}</td>
                            <td><a href="/show_edit_vehicle/id_vehicle/{{$p->id_vehicle}}">&#9998;</a></td>
                            <td><a href="/delete_vehicle/id_vehicle/{{$p->id_vehicle}}">&cross;</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <footer class=" bg-dark fixed-bottom">
        <div class="container text-center">

            <p><a class="text-white" href="#">Copyright by PHP LARAVEL 2019</a></p>
        </div>
    </footer>
    @else
    <div class="card-header">Dashboard</div>
    <div class="card-body">
        <h4>You are not logged in please , <a href="{{ route('login') }}">login</a>
            , or <a href="{{route('register')}}">register</a></h4>
    </div>
    </div>
    @endif
</body>

</html>