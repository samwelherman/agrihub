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
                    <th><input type="text" name='warehouse' class="form-control" id="warehouseid" placeholder="search by warehouse"></th>
                    <th> <input type="text" name='crop_type' class="form-control" id="crop_typeid" placeholder="search by Crops Type"></th>
                    <th> <input type="text" name='quantity' class="form-control" id="quantityid" placeholder="search by Quantity"></th>
                    <th> <input type="text" name='region' class="form-control" id="regionid" placeholder="search by Region"></th>
                    <th> <input type="text" name='destrict' class="form-control" id="destrictid" placeholder="search by Destrict"></th>
                    <th> <h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form"><i class="fa fa-search"></i></button></h4></th>
                    
                  </tr>
                   <tr>
                        <td>Mkwakwani ltd</td>
                        <td>Mahindi</td>
                        <td>100000kg</td>
                        <td>Tanga</td>
                        <td>Tanga</td>
                        <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
                    </tr>
                    <tr>
                        <td>Mbeya ltd</td>
                        <td>Mpunga</td>
                        <td>600000kg</td>
                        <td>Mbeya</td>
                        <td>kyera</td>
                        <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
                    </tr>
                    <tr>
                        <td>Mkwakwani ltd</td>
                        <td>Mahindi</td>
                        <td>100000kg</td>
                        <td>Tanga</td>
                        <td>Tanga</td>
                        <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
                    </tr>
                    <tr>
                        <td>Mkwakwani ltd</td>
                        <td>Maharage</td>
                        <td>1200000kg</td>
                        <td>Tanga</td>
                        <td>Tanga</td>
                        <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
                    </tr>
                    <tr>
                        <td>Mbwa ltd</td>
                        <td>Miwa</td>
                        <td>330000kg</td>
                        <td>Morogoro</td>
                        <td>kirombelo</td>
                        <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
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
      </div>
    </div>
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