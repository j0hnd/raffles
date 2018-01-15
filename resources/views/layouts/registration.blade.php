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
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            @yield('main-content')
                        </div>
                    </div>
                </section>
            </div><!-- ./wrapper -->
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <!-- <script src="{{ url('/js/bootstrap-datepicker.js') }}" type="text/javascript"></script> -->
        <!-- <script src="{{ url('/js/class/users.js') }}" type="text/javascript"></script> -->
        @yield('custom-js')
    </body>
</html>
