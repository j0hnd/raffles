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
            @include('Partials.Forms._raffle')
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
