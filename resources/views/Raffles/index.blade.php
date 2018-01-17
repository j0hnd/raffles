@extends('layouts.app')

@section('main-content')
<div class="row">
    <h1>Raffles</h1>
</div>

<div class="row">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="col-md-3">Raffle Name</th>
                    <th class="col-md-3">Raffle URL</th>
                    <th class="col-md-2 text-center">Start Date</th>
                    <th class="col-md-2 text-center">End Date</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody id="raffle-list-container">
                @include('Partials.Raffles._list', compact('raffles'))
            </tbody>
            @if (count($raffles))
            <tfoot>
                <tr>
                    <td colspan="5" class="text-right">{{ $raffles['object']->links() }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

@include('Partials.Modals._modals')

@endsection

@section('custom-js')
<script src="{{ url('js/class/raffles.js') }}" type="text/javascript"></script>
<script src="{{ url('js/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
tinymce.init({
    selector:'textarea',
    menubar: false,
    setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
});
</script>
@endsection
