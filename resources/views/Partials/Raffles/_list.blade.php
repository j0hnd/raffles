@if (count($raffles))
    @foreach ($raffles as $raffle)
    <tr data-id="{{ $raffle['raffle_id'] }}">
        <td>{{ $raffle['raffle_name'] }}</td>
        <td>{{ $raffle['raffle_url'] }}</td>
        <td class="text-center">{{ !empty($raffle['start_date']) ? date('M. j, Y', strtotime($raffle['start_date'])) : "not set" }}</td>
        <td class="text-center">{{ !empty($raffle['end_date']) ? date('M. j, Y', strtotime($raffle['end_date'])) : "not set" }}</td>
        <td>
            <button type="button" id="toggle-edit-raffle" class="btn btn-primary" data-id="{{ $raffle['raffle_id'] }}" data-name="{{ $raffle['raffle_name'] }}" data-start="{{ $raffle['start_date'] }}" data-end="{{ $raffle['end_date'] }}">Edit</button>
            <button type="button" id="toggle-raffle-entries" class="btn btn-primary" data-id="{{ $raffle['raffle_id'] }}">Entries</button>
            <button type="button" id="toggle-draw-raffle" class="btn btn-success" data-id="{{ $raffle['raffle_id'] }}">Draw</button>
            <button type="button" id="toggle-delete-raffle" class="btn btn-danger" data-id="{{ $raffle['raffle_id'] }}" data-name="{{ $raffle['raffle_name'] }}">Delete</button>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">No raffles found!</td>
    </tr>
@endif
