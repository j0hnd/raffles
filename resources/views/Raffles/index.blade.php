@extends('layouts.app')

@section('main-content')
<div class="row bg-primary padding-10 margin-top15 margin-bottom15">
    <div class="col-md-6 text-left">
        <button type="button" id="toggle-create-raffle" class="btn btn-link controls">Create Raffle</button>
        <button type="button" id="toggle-draw-winner" class="btn btn-link controls">Draw Winner</button>
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
                <th class="col-md-5">Raffle Name</th>
                <th class="col-md-3">Raffle URL</th>
                <th class="col-md-2">Start Date</th>
                <th class="col-md-2">End Date</th>
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
