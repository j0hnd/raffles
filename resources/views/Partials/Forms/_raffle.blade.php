<div class="col-md-12">
    {!! Form::open(['id' => 'raffle-form', 'method' => 'post']) !!}
        <div class="form-group">
            <label for="raffle-name">Raffle Name</label>
            <input type="text" class="form-control" id="raffle-name" name="name" placeholder="Raffle Name">
        </div>

        <div class="form-group">
            <label for="raffle-url">Raffle URL</label>
            <input type="url" class="form-control" id="raffle-url" name="raffle_url" placeholder="Raffle URL">
        </div>

        <div class="row">
            <div class="col-xs-5">
                <label for="start-date">Start Date</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input type="date" class="form-control" id="start-date" name="start_date" placeholder="mm/dd/yyyy">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-5">
                <label for="end-date">End Date</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    <input type="date" class="form-control" id="end-date" name="end_date" placeholder="mm/dd/yyyy">
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
