@extends('layouts.registration')

@section('main-content')
<div class="login-box">
    <div class="login-box-body">
        <p class="login-box-msg"> Sign Up With Email </p>

        <form id="registration-form" method="post">
            <div class="form-group">
                <!-- <label for="email">Email address</label> -->
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        {!! Form::close() !!}
    </div>
</div>
@endsection
