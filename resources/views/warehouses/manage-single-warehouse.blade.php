@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-body">
      <div class="row mt-sm-4">
    
        <div class="col-12 col-md-12 col-lg-12">
          <div id="single_warehouse">
            <single_warehouse></single_warehouse>
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
  
   <!--Add new Account model -->
  <div class="modal fade" id="newacount_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Famer Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" method="post" action="{{url('addfarmeraccount/save')}}">
        {{ csrf_field() }}
          <div class="card-body">
            
            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                  <!-- intput for capture warehouseid hidden-->
                  <input type="hidden" value="{{$warehouse->id}}" name='warehouseid' >
                  <label for="selectfamer">Select Famer</label>
                  <select name="selectfamer" class="form-control">
                  <option value="">Select Famer</option>
                      @if(isset($farmer))
                        @foreach($farmer as $farmer)
                          <option value="{{$farmer->id}}">{{$farmer->firstname}} {{$farmer->lastname}}</option>
                        @endforeach
                        @endif
                  </select>
                </div>
                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                  <label for="cropstype">Crops Type</label>
                  <select name="cropstype" class="form-control">
                      <option value=''>Select Crops Type</option>
                       @if(isset($crops_types))
                        @foreach($crops_types as $crops_type)
                          <option value="{{$crops_type->id}}">{{$crops_type->crop_name}} </option>
                        @endforeach
                        @endif
                  </select>
                </div>
            
            <div class="form-row">
               <div class="form-group col-md-12 col-lg-12">
    
                <input type="submit" value="Add" name="save" class="btn btn-block btn-primary">
              </div>
            </div>
          </div>
  </form>
    </div>
  </div>
</div>
<!-- end of Add new account model -->

 <!--Deposity model -->
              <div class="modal fade" id="deposity_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deposity Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form class="form" method="post" action="{{url('deposity/save')}}">
                    {{ csrf_field() }}
                      <div class="card-body">
                       <!-- intput for capture warehouseid hidden-->
                  <input type="hidden" value="{{$warehouse->id}}" name='warehouseid' >
                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                           <label for="deposityquantity">Quantity in Kilogram(Kg)</label>
                            <input type="number"  name='deposityquantity' class="form-control" id="deposityquantityid" placeholder="Enter Quantity in Kilogram(Kg)">
                                @error('deposityquantity')
                            <div class="text-danger">{{$message }}</div>
                            @enderror
                        </div>
                         <div class="form-group col-md-12 col-lg-12 col-xl-12">
                           <label for="deposityprice">Deposity Cost</label>
                            <input type="number" name='deposityprice' class="form-control" id="depositypriceid" placeholder="Enter Deposity Cost in Tsh">
                                @error('deposityprice')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-row">
                           <div class="form-group col-md-12 col-lg-12">
                
                            <input type="submit" value="Add" name="save" class="btn btn-block btn-primary">
                          </div>
                        </div>
                      </div>
              </form>
                </div>
              </div>
            </div>
            <!-- end of Deposity model -->
            
            <!--Withdraw model -->
              <div class="modal fade" id="withdraw_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Withdraw Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form class="form" method="post" action="{{url('withdraw/save')}}">
                    {{ csrf_field() }}
                      <div class="card-body">
                          <!-- intput for capture warehouseid hidden-->
                          <input type="hidden" value="{{$warehouse->id}}" name='warehouseid' >
                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                           <label for="deposityquantity">Quantity in Kilogram(Kg)</label>
                            <input type="text" name='withquantity' class="form-control" id="deposityquantityid" placeholder="Enter Quantity in Kilogram(Kg)">
                                @error('deposityquantity')
                            <div class="text-danger">{{$message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-row">
                           <div class="form-group col-md-12 col-lg-12">
                
                            <input type="submit" value="Add" name="save" class="btn btn-block btn-primary">
                          </div>
                        </div>
                      </div>
              </form>
                </div>
              </div>
            </div>
<!-- end of withdraw model -->

<div class="modal inmodal" id="appFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="dealogbox">

    </div>
</div>


  @endsection