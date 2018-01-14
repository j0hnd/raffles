@if (count($raffles))
    @foreach ($raffles as $raffle)
    <tr data-id="{{ $raffle->raffle_id }}">
        <td>{{ $raffle->name }}</td>
        <td>{{ $raffle->raffle_url }}</td>
        <td>{{ $raffle->start_date }}</td>
        <td>{{ $raffle->end_date }}</td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="4" class="text-center">No raffles found!</td>
    </tr>
@endif
