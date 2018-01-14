<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name') }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ url('/css/raffles.css') }}">
        @yield('custom-css')
    </head>

    <body>
        <div id="app">
            <div class="container">
                <section class="wrapper">
                    @if (Auth::check())
                    <div class="row bg-primary padding-10 margin-top15 margin-bottom15">
                        <div class="col-md-6 text-left">
                            <button type="button" id="toggle-create-raffle" class="btn btn-link controls">Create Raffle</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" id="toggle-logout" class="btn btn-link controls">Logout</button>
                        </div>
                    </div>
                    @endif

                    @yield('main-content')
                </section>
            </div><!-- ./wrapper -->
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <!-- <script src="{{ url('/js/bootstrap-datepicker.js') }}" type="text/javascript"></script> -->
        <script src="{{ url('/js/class/users.js') }}" type="text/javascript"></script>
        @yield('custom-js')
    </body>
</html>
