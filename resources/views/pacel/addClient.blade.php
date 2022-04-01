<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="formModal">Add Supplier</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
           <form id="addClientForm" method="post" action="javascript:void(0)">
            @csrf
        <div class="modal-body">
            <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-6 col-lg-6 col-xl-6">
                    <label for="inputEmail4">Supplier Name</label>
                    <input type="text" name='name' id='name' class="form-control" id="inputEmail4" placeholder="">
                        @error('name')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6">
                    <label for="inputEmail4">Address</label>
                    <input type="text" name='address' id='address' class="form-control" id="inputEmail4" placeholder="">
                        @error('address')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                  <label for="inputEmail4">Phone</label>
                  <input type="text" name='phone' id='phone' class="form-control" id="inputEmail4" placeholder="">
                      @error('phone')
                  <div class="text-danger">{{$message }}</div>
                  @enderror
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6 col-lg-6 col-xl-6">
                    <label for="inputEmail4">TIN</label>
                    <input type="text" name='TIN' id='TIN' class="form-control" id="name" placeholder="">
                        @error('TIN')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                  </div>
                  <div class="form-group col-md-6 col-lg-6 col-xl-6">
                    <label for="inputEmail4">Email</label>
                    <input type="text" name='email' id='email' class="form-control" id="email" placeholder="">
                        @error('email')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                  </div>
                  </div>
                 
               
              </div>

        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="submit" class="btn btn-primary" id="save" onclick="saveClient(this)" data-dismiss="modal">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>


       </form>


    </div>
</div>

<script>    

</script> 