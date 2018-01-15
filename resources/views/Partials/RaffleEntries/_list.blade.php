@if (isset($entries))
    @foreach ($entries as $entry)
    <tr data-id="{{ $entry->raffle_entry_id }}">
        <td>{{ $entry->email }}</td>
        <td>{{ $entry->code }}</td>
        <td>{{ $entry->action_name }}</td>
        <td>{{ date('M. j, Y', strtotime($entry->created_at)) }}</td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">No raffle ntries found</td>
    </tr>
@endif
