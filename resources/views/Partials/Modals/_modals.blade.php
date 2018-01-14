<div id="raffleAddModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Create Raffle</h4>
      </div>

      <div class="modal-body">
        @include('Partials.Common._flash')

        <div id="edit-license-container">
          <div class="row">
              <div class="col-md-12">
                  {!! Form::open(['id' => 'raffle-form', 'method' => 'post']) !!}
                    @include('Partials.Forms._raffle')
                  {!! Form::close() !!}
              </div>

          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="button" id="toggle-submit" class="btn btn-primary">Submit</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="raffleEditModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Edit Raffle</h4>
      </div>

      <div class="modal-body">
        @include('Partials.Common._flash')

        <div id="edit-license-container">
          <div class="row">
            {!! Form::open(['id' => 'edit-raffle-form', 'method' => 'put']) !!}
              @include('Partials.Forms._raffle')
            {!! Form::close() !!}
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="button" id="toggle-update" class="btn btn-primary">Update</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="raffleEntriestModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Raffle Entries</h4>
      </div>

      <div class="modal-body">
        <div id="raffle-entries-container">
          <div class="row">
              @include('Partials.Raffles._entries')
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="" class="btn btn-link" data-dismiss="modal">Close</button>
        <!-- <button type="button" id="toggle-update" class="btn btn-primary">Update</button> -->
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="raffleDeleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Delete Raffle</h4>
      </div>

      <div class="modal-body">
        @include('Partials.Common._flash')
        
        <div id="raffle-entries-container">
          <div class="row">
            <div class="col-xs-12">
              <p id="delete-message"></p>
            </div>
          </div>
        </div>

        <input type="hidden" id="id" name="id">
      </div>

      <div class="modal-footer">
        <button type="button" id="" class="btn btn-link" data-dismiss="modal">Close</button>
        <button type="button" id="toggle-delete" class="btn btn-danger">Delete</button>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
