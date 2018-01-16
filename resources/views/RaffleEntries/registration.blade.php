@extends('layouts.registration')

@section('main-content')
<div class="login-box">
    <div class="text-center">
        <h2>{{ ucwords($raffle_info->name) }}</h2>
    </div>

    @if (count($errors->all()))
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="login-box-body">
        <p class="login-box-msg"> Sign Up With Email </p>

        <form id="registration-form" action="{{ $form_action }}" method="post">
            <div class="form-group">
                <!-- <label for="email">Email address</label> -->
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
            </div>

            <div class="row margin-bottom20">
                <div class="col-md-12 padding-left25">
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_KEY') }}"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="raffle_id" value="{{ $raffle_info->raffle_id }}">
        {!! Form::close() !!}
    </div>

    <div class="text-center margin-top10">
        <p>Days Remaining: {{ $days_remaining }} days</p>
    </div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript">
    if ($('.alert').is(':visible')) {
        setTimeout(function () {
            $('.alert').hide();
        }, 3000);
    }
</script>
@endsection
