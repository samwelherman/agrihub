<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="formModal">Assign Truck</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{ Form::model($id, array('route' => array('purchase_tyre.save'), 'method' => 'POST')) }}
        <div class="modal-body">
            <p><strong>Make sure you enter valid information</strong> .</p>
                     
                 <div class="form-group">
                <label class="col-lg-6 col-form-label">Tyre</label>

                <div class="col-lg-12">
                    <select name="tyre"
                    class="form-control" required>
                    <option value="">Select Item</option>
                    @foreach($name as $n) 
                    <option value="{{ $n->id}}">{{$n->serial_no}}</option>
                    @endforeach
                </select>

                <input type="hidden" name="id" value="{{$id}}" required class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-6 col-form-label">Mechanical</label>

                <div class="col-lg-12">
                    <select name="staff"
                    class="form-control" required>
                    <option value="">Select</option>
                    @foreach($staff as $s) 
                    <option value="{{ $s->id}}">{{$s->name}}</option>
                    @endforeach
                </select>
                    
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