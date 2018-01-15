<div class="col-md-12">
    <div class="form-group">
        <label for="raffle-name">Raffle Name</label>
        <input type="text" class="form-control" id="raffle-name" name="name" placeholder="Raffle Name">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="8" cols="80"></textarea>
    </div>

    <div class="row">
        <div class="col-xs-5">
            <label for="start-date">Start Date</label>
            <div class="input-group date datepicker">
                <input type="text" class="form-control" id="start-date" name="start_date" placeholder="mm/dd/yyyy">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-5">
            <label for="end-date">End Date</label>
            <div class="input-group date datepicker">
                <input type="text" class="form-control" id="end-date" name="end_date" placeholder="mm/dd/yyyy">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>

    {!! Form::hidden('id', null, ['id' => 'id']) !!}
</div>
