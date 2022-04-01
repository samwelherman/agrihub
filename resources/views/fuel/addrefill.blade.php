<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="formModal">Refill Fuel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{ Form::model($id, array('route' => array('fuel.update', $id), 'method' => 'PUT')) }}
        <div class="modal-body">
            <p><strong>Make sure you enter valid information</strong> .</p>
            <div class="form-group">
                <label class="col-lg-6 col-form-label">Price per Litres</label>

                <div class="col-lg-12">
                    <input type="number" name="price" value="" id="price" required class="form-control" onkeyup=" calculateDiscount();">
                    
                </div>
            </div>
          
                 <div class="form-group">
                <label class="col-lg-6 col-form-label">Volume Refill</label>

                <div class="col-lg-12">
                    <input type="number" name="litres" value="" required class="form-control" id="litres"  onkeyup=" calculateDiscount();">
                    <input type="hidden" name="type" value="refill" >
                </div>
            </div>


            <div class="form-group">
                <label class="col-lg-6 col-form-label">Total Cost</label>

                <div class="col-lg-12">
                    <input type="number" name="total_cost" id="total_cost" value="" required class="form-control" readonly>
                </div>
            </div>


        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>