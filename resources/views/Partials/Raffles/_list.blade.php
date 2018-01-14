@if (count($raffles['data']))
    @foreach ($raffles['data'] as $raffle)
        @php
            if (strtotime('now') > strtotime($raffle['end_date'])) {
                $tr_background = "bg-danger raffle-ended";
            } else {
                $tr_background = "";
            }
        @endphp

    <tr class="{{ $tr_background }}" data-id="{{ $raffle['raffle_id'] }}" >
        <td>{{ $raffle['raffle_name'] }}</td>
        <td>{{ $raffle['raffle_url'] }}</td>
        <td class="text-center">{{ !empty($raffle['start_date']) ? date('M. j, Y', strtotime($raffle['start_date'])) : "not set" }}</td>
        <td class="text-center">{{ !empty($raffle['end_date']) ? date('M. j, Y', strtotime($raffle['end_date'])) : "not set" }}</td>
        <td>
            <button type="button" id="toggle-edit-raffle" class="btn btn-default" data-id="{{ $raffle['raffle_id'] }}" data-name="{{ $raffle['raffle_name'] }}" data-start="{{ $raffle['start_date'] }}" data-end="{{ $raffle['end_date'] }}" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="glyphicon glyphicon-edit"></span></button>
            <button type="button" id="toggle-raffle-entries" class="btn btn-default" data-id="{{ $raffle['raffle_id'] }}" data-toggle="tooltip" data-placement="bottom" title="Raffle Entries"><span class="glyphicon glyphicon-th-list"></span></button>
            <button type="button" id="toggle-draw-raffle" class="btn btn-success" data-id="{{ $raffle['raffle_id'] }}" data-toggle="tooltip" data-placement="bottom" title="Draw raffle"><span class="glyphicon glyphicon-retweet"></span></button>
            <button type="button" id="toggle-delete-raffle" class="btn btn-danger" data-id="{{ $raffle['raffle_id'] }}" data-name="{{ $raffle['raffle_name'] }}" data-toggle="tooltip" data-placement="bottom" title="Delete raffle"><span class="glyphicon glyphicon-trash"></span></button>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">No raffles found!</td>
    </tr>
@endif
