@extends('layouts.app')

@section('main-content')
<div class="row bg-primary padding-10 margin-top15 margin-bottom15">
    <div class="col-md-6 text-left">
        <button type="button" id="toggle-create-raffle" class="btn btn-link controls">Create Raffle</button>
    </div>
    <div class="col-md-6 text-right">
        <button type="button" id="toggle-logout" class="btn btn-link controls">Logout</button>
    </div>
</div>

<div class="row">
    <h1>Raffles</h1>
</div>

<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="col-md-3">Raffle Name</th>
                <th class="col-md-4">Raffle URL</th>
                <th class="col-md-1 text-center">Start Date</th>
                <th class="col-md-1 text-center">End Date</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody id="raffle-list-container">
            @include('Partials.Raffles._list', compact('raffles'))
        </tbody>
    </table>
</div>

@include('Partials.Modals._modals')

@endsection

@section('custom-js')
<script src="{{ url('js/class/raffles.js') }}" type="text/javascript"></script>
@endsection
