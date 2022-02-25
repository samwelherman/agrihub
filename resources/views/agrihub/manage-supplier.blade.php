@extends('layouts.master')

@section('content')

  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <!-- alert -->
          @if(Session::get('messagev'))
          <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              {{Session::get('messagev')}}
            </div>
          </div>
          @endif
          @if(Session::get('messager'))
          <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>×</span>
              </button>
              {{Session::get('messager')}}
            </div>
          </div>
           @endif

          <!-- end of alert -->
          <div class="card">
            <div class="card-header">
              
                <h4>Supplier</h4>
                <div class="card-header-form">
                  
                    <div class="input-group">
                      <h4><button class="btn btn-primary"  data-toggle="modal" data-target="#owner">Add Supplier <i class="fa fa-plus"></i></button></h4>
                    </div>
                  
                </div>
              
              
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 col-xl-12 col-md-12">
                  <div class="table-responsive">
                    @if(count($supply)>0)
                        <table class="table table-striped table-md">
                          <tbody><tr>
                            <th>Supplier Name</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>TIN</th>
                            <th>Email</th>
                            <th>Action</th>
                          </tr>
                          
                          @foreach($supply as $supplier)
                             <tr>
                            <td>{{$supplier->name}}</td>
                            <td> {{$supplier->address}}</td>
                            <td>
                            {{$supplier->phone}}
                            </td>
                            <td>{{$supplier->TIN}}</td>
                            <td>
                              {{$supplier->email}}
                              </td>
                              
                               
                            <td>
                              <div class="row">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                            
                              <a href="#"   data-toggle="modal" data-target="#owner{{$supplier->id}}"><i class="fas fa-edit"></i></a>

                              <a href="#"  data-toggle="modal" data-target="#del{{$supplier->id}}"><i class="fas fa-trash-alt"></i></a>

                              
                                </div>
                            </td>
                             </tr>
                            
                          @endforeach
                          @else
                          No data available
                          @endif
                          
                        </tbody>
                        
                      </table>
                      </div>
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
                </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        </div>
    </div>
    
  </section>
  <!-- delete modal -->
 
  @foreach($supply as $supply)
  <div class="modal fade" id="del{{$supply->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete?
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" type="submit"  class="btn btn-danger"><a href="{{url('supplier/'.$supply->id.'/delete')}}" style="color:white;font-weight:bold">Delete</a></button>
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 @endforeach

<!-- end of the delete model -->


  <!--create owner modal -->
  <div class="modal fade" id="owner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" method="post" action="{{url('supplier/save')}}">
        {{ csrf_field() }}
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6 col-lg-6 col-xl-6">
                <label for="inputEmail4">Supplier Name</label>
                <input type="text" name='name' class="form-control" id="inputEmail4" placeholder="">
                    @error('name')
                <div class="text-danger">{{$message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-6 col-lg-6 col-xl-6">
                <label for="inputEmail4">Address</label>
                <input type="text" name='address' class="form-control" id="inputEmail4" placeholder="">
                    @error('address')
                <div class="text-danger">{{$message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group col-md-12 col-lg-12 col-xl-12">
              <label for="inputEmail4">Phone</label>
              <input type="text" name='phone' class="form-control" id="inputEmail4" placeholder="">
                  @error('phone')
              <div class="text-danger">{{$message }}</div>
              @enderror
            </div>
            <div class="form-row">
              <div class="form-group col-md-6 col-lg-6 col-xl-6">
                <label for="inputEmail4">TIN</label>
                <input type="text" name='TIN' class="form-control" id="name" placeholder="">
                    @error('TIN')
                <div class="text-danger">{{$message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-6 col-lg-6 col-xl-6">
                <label for="inputEmail4">Email</label>
                <input type="text" name='email' class="form-control" id="email" placeholder="">
                    @error('email')
                <div class="text-danger">{{$message }}</div>
                @enderror
              </div>
              </div>
             
            <div class="form-row">
               <div class="form-group col-md-12 col-lg-6">
                  <input type="submit" onclick="submit()"  value="Save" name="save" class="btn btn-block btn-primary">
              
              </div>
            </div>
          </div>
  </form>
    </div>
  </div>
</div>
<!-- end of the supplier modal -->
<!-- edit modal -->
@foreach($supply2 as $supply)
<div class="modal fade" id="owner{{$supply->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit farm asset</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form class="form" method="post" action="{{url('land/'.$supply->id.'/edit')}}">
      {{ csrf_field() }}
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-6 col-lg-6 col-xl-6">
              <label for="inputEmail4">Supply Name</label>
              <input type="text" value="{{$supply->name}}" name='registration' class="form-control" id="inputEmail4" placeholder="">
                  @error('registration')
              <div class="text-danger">{{$message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-6 col-lg-6 col-xl-6">
              <label for="inputEmail4">Supply Address</label>
              <input type="text" name='address' value="{{$supply->address}}" class="form-control" id="inputEmail4" placeholder="">
                  @error('address')
              <div class="text-danger">{{$message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-row">
          <div class="form-group col-md-6 col-lg-6 col-xl-6">
            <label for="inputEmail4">Phone</label>
            <input type="text" name='phone' value="{{$supply->phone}}" class="form-control" id="inputEmail4" placeholder="">
                @error('phone')
            <div class="text-danger">{{$message }}</div>
            @enderror
          </div>
          
          <div class="form-group col-md-6 col-lg-6 col-xl-6">
            <label for="inputEmail4">TIN</label>
            <input type="text" name='TIN' value="{{$supply->TIN}}" class="form-control" id="inputEmail4" placeholder="">
                @error('TIN')
            <div class="text-danger">{{$message }}</div>
            @enderror
          </div>
          <div class="form-group col-md-12 col-lg-12 col-xl-12">
            <label for="inputEmail4">Email</label>
            <input type="text" name='email' value="{{$supply->email}}" class="form-control" id="inputEmail4" placeholder="">
                @error('email')
            <div class="text-danger">{{$message }}</div>
            @enderror
          </div>
            </div>
           
          <div class="form-row">
             <div class="form-group col-md-12 col-lg-12">
  
              <input type="submit" value="Save edit" name="save" class="btn btn-block btn-primary">
            </div>
          </div>
        </div>
</form>
  </div>
</div>
</div>
@endforeach
<!-- end of the edit modal -->
@endsection