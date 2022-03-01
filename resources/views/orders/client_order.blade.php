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
                 <div id="makeorder">
                   <makeorder-component></makeorder-component>
                   </div>  
               
              </div>
            </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{mix('js/app.js')}}"></script>
    <script type="text/javascript">
    function model( type,account_id,warehouse_id) {

        let url = '{{ route("singlewarehouse.show", ":id") }}';
        url = url.replace(':id', account_id)

        $.ajax({
            type: 'GET',
            url: url,
            data: {
                'type': type,
                'warehouse_id':warehouse_id,
                'account_id':account_id,
            },
            cache: false,
            async: true,
            success: function(data) {
                //alert(data);
                $('.dealogbox').html(data);
            },
            error: function(error) {
                $('#appFormModal').modal('toggle');

            }
        });

    }
    </script>
  </section>
  
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

 
        

<div class="modal inmodal" id="appFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="dealogbox">

    </div>
</div>


  @endsection