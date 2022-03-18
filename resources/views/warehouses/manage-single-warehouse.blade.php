@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-body">
      <div class="row mt-sm-4">
    
        <div class="col-12 col-md-12 col-lg-12">
          <div id="single_warehouse">
            <div>
              <div class="card">
                   <div class="card-header">
                     <h4>warehouse.warehouse_name</h4>
                   </div>
                   <div class="row">
                   <div class="col-12 col-sm-12 col-lg-2 col-xl-2 col-md-2">
                         <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                            <li class="nav-item">
                             <a class="nav-link  active" id="profile-tab4" data-toggle="tab" href="#accounts" role="tab" aria-controls="accounts" aria-selected="true">Accounts</a>
                           </li>
                           <li class="nav-item">
                             <a class="nav-link" id="home-tab4" data-toggle="tab" href="#orders" role="tab" aria-controls="home" aria-selected="false">Orders</a>
                           </li>
                         </ul>
                   </div>
       
       
       
       
                    <div class="col-12 col-sm-12 col-lg-10 col-xl-10 col-md-10">
                         <div class="tab-content no-padding" id="myTab2Content">
                 <div class="tab-pane fade active show" id="accounts" role="tabpanel" aria-labelledby="accounts">
                           <div class="padding-20">
                     <ul class="nav nav-tabs" id="myTab2" role="tablist">
                       <li class="nav-item">
                         <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about1" role="tab"
                           aria-selected="true">Famer Accounts</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#deposity1" role="tab"
                           aria-selected="false">Deposite History</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" id="farm land" data-toggle="tab" href="#withdraw1" role="tab"
                             aria-selected="false">Withdraw History</a>
                         </li>
                     </ul>
                     
                     <div class="tab-content tab-bordered" id="myTab3Content">
                       
                       
                       <div class="tab-pane fade show active" id="about1" role="tabpanel" aria-labelledby="home-tab2">
                         <h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Add New Account <i class="fa fa-plus"></i></button></h4>
                        <div class="table-responsive">
                            
                                   <table class="table table-striped table-md">
                                     <tbody><tr>
                                 
                                       <th>Account Name</th>
                                       <th>Famer Name</th>
                                       <th>Crops Type</th>
                                       <th>Total Quantity</th>
                                       <th>Action</th>
                                     </tr>
                                        <tr v-for="(account,index) in accounts" :key="index">
                                          <td></td>
                                          <td></td>
                                       <td></td>
                                       <td>kg</td>
                                       <td>
                                         <div class="row">
                                         <div class="col-lg-12 col-sm-12 col-md-12">
                                         <a class="btn btn-primary"  data-toggle="modal"   data-target="#appFormModal" href="#" >deposite <i class="fas fa-plus"></i></a>
                                         <a  class="btn btn-primary"  data-toggle="modal"  data-target="#appFormModal" href="#">withdraw <i class="fas fa-minus"></i></a>
       
                                           </div>
                                         </div>
                                       </td>
                                        </tr>
                                   
       
                                   </tbody>
                                   <div class="card-footer text-right">
                                     <nav class="d-inline-block">
                                       <ul class="pagination mb-0">
                                         <li class="page-item disabled">
                                           <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                         </li>
                                         <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#">2</a>
                                         </li>
                                         <li class="page-item"><a class="page-link" href="#">3</a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                         </li>
                                       </ul>
                                     </nav>
                                      </div> 
                                  
                                   
                                 </table>
                                   
                                 </div>
                         </div>
                       
                       <div class="tab-pane fade" id="deposity1" role="tabpanel" aria-labelledby="profile-tab2">
                           <div class="table-responsive">
                        
                                   <table class="table table-striped table-md">
                                     <tbody><tr>
                                 
                                       <th>Famer Account</th>
                                       <th>Crops Type</th>
                                       <th>Date</th>
                                       <th>Quantity</th>
                                       <th>Price</th>
                                     </tr>
                                    
                                       <tr>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       </tr>
                                   
       
                                   </tbody>
                                   <div class="card-footer text-right">
                                     <nav class="d-inline-block">
                                       <ul class="pagination mb-0">
                                         <li class="page-item disabled">
                                           <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                         </li>
                                         <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#">2</a>
                                         </li>
                                         <li class="page-item"><a class="page-link" href="#">3</a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                         </li>
                                       </ul>
                                     </nav>
                                        </div> 
                                 </table>
                                 </div>
                       </div>
                       
                       
                          <div class="tab-pane fade" id="withdraw1" role="tabpanel" aria-labelledby="profile-tab2">
                           <div class="table-responsive">
                      
                                   <table class="table table-striped table-md">
                                     <tbody><tr>
                                 
                                       <th>Famer Account</th>
                                       <th>Crops Type</th>
                                       <th>Date</th>
                                       <th>Quantity</th>
                                     </tr>
                                       <tr >
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td> kg</td>
                                       </tr>
                                    
       
                                   </tbody>
                                   <div class="card-footer text-right">
                                     <nav class="d-inline-block">
                                       <ul class="pagination mb-0">
                                         <li class="page-item disabled">
                                           <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                         </li>
                                         <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#">2</a>
                                         </li>
                                         <li class="page-item"><a class="page-link" href="#">3</a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                         </li>
                                       </ul>
                                     </nav>
                                      </div> 
                                 </table>
                                 </div>
                       </div>
                       
                       
                     </div>
                   </div>
                 </div>
                 <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="profile-tab4">
                           <div class="padding-20">
                     <ul class="nav nav-tabs" id="myTab2" role="tablist">
                       <li class="nav-item">
                         <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                           aria-selected="true">Order Request</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#deposity" role="tab"
                           aria-selected="false">Created Order</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link" id="farm land" data-toggle="tab" href="#withdraw" role="tab"
                             aria-selected="false">Order Progress</a>
                         </li>
                     </ul>
                     
                     <div class="tab-content tab-bordered" id="myTab3Content">
                       
                       
                       <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <div class="table-responsive">
                                   <table class="table table-striped table-md">
                                     <tbody><tr>
                                       <th>Crops Type</th>
                                       <th>Quantity</th>
                                       <th>Requested By</th>
                                       <th>Requested at</th>
                                       <th>Action</th>
                                     </tr>
                                     <tr >
                                     <td> </td>
                                     <td> </td>
                                     <td></td>
                                     <td></td>
                                     <td>
                                       <div class="row">
                                       <div class="col-lg-12 col-sm-12 col-md-12">
                                         <button class="btn btn-primary"  data-toggle="modal"  data-target="#createOrder" href="#">Order</button>
                                       </div>
                                       </div>
                                     </td>
                                       </tr>
                                   </tbody>
                                   <div class="card-footer text-right">
                                     <nav class="d-inline-block">
                                       <ul class="pagination mb-0">
                                         <li class="page-item disabled">
                                           <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                         </li>
                                         <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#">2</a>
                                         </li>
                                         <li class="page-item"><a class="page-link" href="#">3</a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                         </li>
                                       </ul>
                                     </nav>
                                      </div> 
                                 </table>
                                   
                                 </div>
                         </div>
                       
                       <div class="tab-pane fade" id="deposity" role="tabpanel" aria-labelledby="profile-tab2">
                           <div class="table-responsive">
                           
                                   <table class="table table-striped table-md">
                                     <tbody><tr>
                                       <th>Crops Type</th>
                                       <th>Quantity</th>
                                       <th>Requested By</th>
                                       <th>Requested at</th>
                                       <th>Created at</th>
                                     </tr>
                                     <tr >
                                     <td> </td>
                                     <td> </td>
                                     <td></td>
                                     <td></td>
                                     <td>
                                       
                                     </td>
                                       </tr>
                                   </tbody>
                                   <div class="card-footer text-right">
                                     <nav class="d-inline-block">
                                       <ul class="pagination mb-0">
                                         <li class="page-item disabled">
                                           <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                         </li>
                                         <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#">2</a>
                                         </li>
                                         <li class="page-item"><a class="page-link" href="#">3</a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                         </li>
                                       </ul>
                                     </nav>
                                   </div> 
                                 </table>
                                 </div>
                             </div>
                       
                       
                          <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="profile-tab2">
                           <div class="table-responsive">
                                   <table class="table table-striped table-md">
                                     <tbody>
                                        <tr>
                                       <th>Crops Type</th>
                                       <th>Quantity</th>
                                       <th>Requested By</th>
                                       <th>Requested at</th>
                                       <th>Order Status</th>
                                     </tr>
                                     <tr >
                                     <td> </td>
                                     <td> </td>
                                     <td></td>
                                     <td></td>
                                     <td>
                                      
                                     </td>
                                     </tr>
                                   </tbody>
                                   <div class="card-footer text-right">
                                     <nav class="d-inline-block">
                                       <ul class="pagination mb-0">
                                         <li class="page-item disabled">
                                           <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                         </li>
                                         <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#">2</a>
                                         </li>
                                         <li class="page-item"><a class="page-link" href="#">3</a></li>
                                         <li class="page-item">
                                           <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                         </li>
                                       </ul>
                                     </nav>
                                      </div> 
                                   
                                   
                                 </table>
                                
                             
                                 </div>
                       </div>
                       
                       
                     </div>
                   </div>   
                   </div>
                           <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                           </div>
       
                         </div>
                       </div>
                   </div>
                   
                 </div>
     
       <div class="modal inmodal" id="createOrder" tabindex="-1" role="dialog" v-if="state.dialog_state">
           <div class="dealogbox" >
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
                       <input type="number" name='orderquantity' class="form-control" id="orderquantityid" placeholder="Enter Quantity in Kilogram(Kg)">
                          
                   </div>
                   <div class="form-group col-md-12 col-lg-12 col-xl-12">
                       <label for="offerAmount">Offer Amount</label>
                        <input type="number"  name='offerAmount' class="form-control" id="offerAmountid" placeholder="Offer Amount in Tsh">
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
      
           </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <script src="{{mix('js/app.js')}}"></script> --}}
    {{-- <script type="text/javascript">
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
    </script> --}}
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
