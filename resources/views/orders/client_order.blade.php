@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-body">
      <div class="row mt-sm-4">
    
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Welcome User name to make your order</h4>
            </div>
            <div class="padding-20">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending"
                                style="width: 186.484px;">Warehouse Name</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1"
                                aria-label="Platform(s): activate to sort column ascending"
                                style="width: 186.484px;">Crops Type</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1"
                                aria-label="Engine version: activate to sort column ascending"
                                style="width: 141.219px;">Quantity</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1"
                                aria-label="Engine version: activate to sort column ascending"
                                style="width: 141.219px;">Region</th>

                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1"
                                aria-label="Engine version: activate to sort column ascending"
                                style="width: 141.219px;">Destrict</th>
        
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1"
                                aria-label="CSS grade: activate to sort column ascending"
                                style="width: 98.1094px;">Actions</th>
                        </tr>
                        <tr>
                          <th><input type="text" name='state.warehouse' class="form-control" id="warehouseid" placeholder="search by warehouse"></th>
                          <th> <input type="text"  name='crop_type' class="form-control" id="crop_typeid" placeholder="search by Crops Type"></th>
                          <th> <input type="number"  name='quantity' class="form-control" id="quantityid" placeholder="search by Quantity"></th>
                          <th> <input type="text" name='region' class="form-control" id="regionid" placeholder="search by Region"></th>
                          <th> <input type="text" name='destrict' class="form-control" id="destrictid" placeholder="search by Destrict"></th>
                          <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div> 
            </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="modal inmodal" id="appFormModal" tabindex="-1" role="dialog" >
      <div class="dealogbox">
     <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Order Form</h5>
                      <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                        <span  >&times;</span>
                      </button>
                    </div>
           
                        <div class="card-body">
              <div class="form-group col-md-12 col-lg-12 col-xl-12">
                 <label for="orderquantity">Quantity in Kilogram(Kg)</label>
                  <input type="number"  name='orderquantity' class="form-control" id="orderquantityid" placeholder="Enter Quantity in Kilogram(Kg)">
                     
              </div>
              <div class="form-group col-md-12 col-lg-12 col-xl-12">
                  <label for="offerAmount">Offer Amount</label>
                   <input type="number" name='offerAmount' class="form-control" id="offerAmountid" placeholder="Offer Amount in Tsh">
               </div>
              <div class="form-row">
                 <div class="form-group col-md-12 col-lg-12">
                  <input type="submit"  value="Submit Order" name="save" class="btn btn-block btn-primary">
                </div>
              </div>
            </div>
              
                  </div>
                </div>
      </div>
  </div>
    
  </section>
  {{-- <create-Order-form-component></create-Order-form-component> --}}
  
   <!--Making Order model -->
  <div class="modal fade" id="newacount_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" method="post" action="">
        {{ csrf_field() }}
          <div class="card-body">
     
            <div class="form-group col-md-12 col-lg-12 col-xl-12">
               <label for="orderquantity">Quantity in Kilogram(Kg)</label>
                <input type="number"  name='orderquantity' class="form-control" id="orderquantityid" placeholder="Enter Quantity in Kilogram(Kg)">
                    @error('deposityquantity')
                <div class="text-danger">{{$message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                <label for="orderquantity"></label>
                 <input type="number"  name='orderquantity' class="form-control" id="orderquantityid" placeholder="Enter Quantity in Kilogram(Kg)">
                    @error('deposityquantity')
                 <div class="text-danger">{{$message }}</div>
                 @enderror
             </div>
            
            <div class="form-row">
               <div class="form-group col-md-12 col-lg-12">
    
                <input type="submit" value="Submit Order" name="save" class="btn btn-block btn-primary">
              </div>
            </div>
          </div>
  </form>
    </div>
  </div>
</div>
<!-- end of Making Order model -->
  @endsection


  @section('scripts')
  <script >
  $(document).ready(function(){
    $('.table').DataTable();//its make all tables in this page to be data table
    getWarehouseDetails();//get warehouses data
    function getWarehouseDetails(){
      let url = '{{route("manipulation.index")}}';
       //setting the x-csrf-token in ajax request
       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      //ajax for get account data
      $.ajax({
        type:"GET",
        url:url,
        dataType:"json",
        cache: false,
        async: true,
        success: function(response) {
           console.log(response);
          //adding row to the account table
          $.each(response,function(key,data){
            $('#table-1').DataTable().row.add([
              data.warehouse.warehouse_name,
              data.crops_type.crop_name,
              data.total_quantity,
              "--",
              "--",
              '<a class="btn btn-xs btn-success"  data-toggle="modal"   data-target="#appFormModal" href="#">Order</a>',
            ]).draw();
              });
            console.log(response);
        },
        error: function(response) {
            console.log(response);
        }
    });
 }  
  });
</script>
@endsection