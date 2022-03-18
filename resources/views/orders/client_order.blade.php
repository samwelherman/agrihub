@extends('layouts.vue_layout')

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
                
              <div>
  
                <table class="table table-striped table-md">
                  <tbody><tr>
                    <th>Warehouse name</th>
                    <th>Crops Type</th>
                    <th>Quantity</th>
                    <th>Region</th>
                    <th>Destrict</th>
                    <th>action</th>
                  </tr>
                  <tr>
                    <th><input type="text" v-model="state.warehouse" name='state.warehouse' class="form-control" id="warehouseid" placeholder="search by warehouse"></th>
                    <th> <input type="text" v-model="state.crops_type" name='crop_type' class="form-control" id="crop_typeid" placeholder="search by Crops Type"></th>
                    <th> <input type="number" v-model="state.quantity" name='quantity' class="form-control" id="quantityid" placeholder="search by Quantity"></th>
                    <th> <input type="text" name='region' class="form-control" id="regionid" placeholder="search by Region"></th>
                    <th> <input type="text" name='destrict' class="form-control" id="destrictid" placeholder="search by Destrict"></th>
                   
                  </tr>
                  <tr v-for="(data,index) in state.filtertabledata" :key="index">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Dar es salaam</td>
                        <td>ilala</td>
                        <!-- <th><create-Order-form-component/></th> -->
                        <td><h4><button class="btn btn-primary"  data-toggle="modal"   data-target="#appFormModal" href="#">Order</button></h4></td>
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
                            <input type="number" v-model="form_data.quantity" name='orderquantity' class="form-control" id="orderquantityid" placeholder="Enter Quantity in Kilogram(Kg)">
                               
                        </div>
                        <div class="form-group col-md-12 col-lg-12 col-xl-12">
                            <label for="offerAmount">Offer Amount</label>
                             <input type="number" v-model="form_data.offer_amount" name='offerAmount' class="form-control" id="offerAmountid" placeholder="Offer Amount in Tsh">
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

 
        

<div class="modal inmodal" id="appFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="dealogbox">

    </div>
</div>

  @endsection
