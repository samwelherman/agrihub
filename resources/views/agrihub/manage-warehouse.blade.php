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
          @if(Session::get('messager')))
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
              <h4>Warehouses</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-12 col-lg-2 col-xl-2 col-md-2">
                  <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                     <li class="nav-item">
                      <a class="nav-link  active" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="true">Manage Warehouses</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="false">Register Warehouse </a>
                    </li>
                  <!--
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                    -->
                  </ul>
                </div>
                
                <div class="col-12 col-sm-12 col-lg-10 col-xl-10 col-md-10">
                  <div class="tab-content no-padding" id="myTab2Content">
                    <div class="tab-pane fade" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                      <div class="card">
                        <div class="card-header">
                          <h4>Create Warehouse</h4>
                        </div>
                        <div class="card-body p-0">
                          <form class="form" method="post" action="{{url('warehouse/save')}}">
                            {{ csrf_field() }}
                              <div class="card-body">
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="warehousename">Warehouse Name</label>
                                  <input type="text" name='warehousename' class="form-control" id="warehousenameid" placeholder="Enter Warehouse Name">
                                      @error('warehousename')
                                <div class="text-danger">{{$message }}</div>
                            @enderror
                                </div>
                          
                                <div class="form-group col-md-6">
                                  <label for="warehouselocation">Warehouse Location</label>
                                  <input type="text" name='warehouselocation' class="form-control" id="warehouselocationid" placeholder="Enter Warehouse Location">
                                   @error('warehouselocation')
                                <div class="text text-danger">{{$message }}</div>
                            @enderror
                                </div>
                            
                                </div>
                                 <div class="form-row">
                                  <div class="form-group col-md-12 col-lg-12 col-sm-12">
                                    <label for="warehouseowner">Warehouse Owner</label>
                                    <select id="warehouseownerid" name="warehouseowner" class="form-control">
                                      <option value="" selected="">Select Warehouse Owner</option>
                                    @if(isset($users))
                                    @foreach($users as $user)
                                      <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                    @endif
                                    </select>
                                  </div>
                                  </div>
                                   <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="insurance">Insurance</label>
                                    <select id="insuranceid" name="insurance" class="form-control">
                                      <option selected="">Select Insurance</option>
                                         @if(isset($insurances))
                                       
                                    @foreach($insurances as $insurance)
                                      <option value="{{$insurance->id}}">{{$insurance->insurance_name}}</option>
                                    @endforeach
                                    @endif
                                    </select>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                  <label for="newinsurance">Add Insurance</label>
                                  <div class="input-group">
                                    <h4 class="btn btn-primary"  data-toggle="modal" data-target="#insurance_form">Add new insurance <i class="fa fa-plus"></i></h4>
                                 </div>
                                  </div>
                                </div>
                                  <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="warehousemanage">Warehouse Manager</label>
                                    <select id="warehousemanageid" name="warehousemanager" class="form-control">
                                      <option selected="">Select Warehouse Manager</option>
                                       @if(isset($users))
                                    @foreach($users as $user)
                                      <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                    @endif
                                    </select>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="managercontact">Manager Contact</label>
                                    <input type="text" name="managercontact" class="form-control" id="managercontact" placeholder="Enter Manager Contact">
                                    @error('managercontact')
                                    <div class="text text-danger">{{$message }}</div>
                                @enderror
                                  </div>
                                </div> 
                               
                               <div class="form-row">
                                <div class="form-group col-md-6 col-lg-6">
                        
                                <input type="submit" value="Save" name="save" class="btn btn-lg btn-primary">
                               </div>
                                </div>
                              </div>
                      </form>
                        </div>
                      
                      </div>
                    </div>
                    <div class="tab-pane fade  active show" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                    <div class="table-responsive">
                      @if(count($warehouse)>0)
                            <table class="table table-striped table-md">
                              <tbody><tr>
                          
                                <th>Warehouse Name</th>
                                <th>Warehouse Owner</th>
                                <th>Manager Phone</th>
                            
                                <th>Warehouse location</th>
                                <th>Action</th>
                              </tr>
                              
                              @foreach($warehouse as $warehouse)
                                 <tr>
                                   <td>{{$warehouse->warehouse_name}}</td>
                                <td>{{$warehouse->warehouse_owner}}</td>
                                <td>{{$warehouse->manager_contact}}</td>
                                
                                <td> {{$warehouse->warehouse_location}}</td>
                                <td>
                                  <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12">
                                  <a href="warehouse/{{$warehouse->id}}/show" ><i class="fas fa-tv"></i></a>
                                  <a href="farmer/{{$warehouse->id}}/edit"><i class="fas fa-edit"></i></a>
                                  <a href="#"  data-toggle="modal" data-target="#basicModal"><i class="fas fa-trash-alt"></i></a>
                                  
                                    </div>
                                </td>
                                 </tr>
                              @endforeach
                            
                              

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
                              @else
                              No data available
                            </div> 
                               @endif
                            
                          </table>
                      
                          </div>
                          
                    </div>
                    <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                     
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
  <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" type="submit"  class="btn btn-danger"><a href="farmer/{{$flist->id ?? ''}}/delete" style="color:white;font-weight:bold">Delete</a></button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end of the delete model -->

 <!--Add new insurance model -->
  <div class="modal fade" id="insurance_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new Insurance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" method="post" action="{{url('addinsurance/save')}}">
        {{ csrf_field() }}
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-6 col-lg-6 col-xl-6">
                <label for="insurancename">Insurance Name</label>
                <input type="text" name='insurancename' class="form-control" id="insurancenameid" placeholder="">
                    @error('insurancename')
                <div class="text-danger">{{$message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-6 col-lg-6 col-xl-6">
                <label for="insuranceamount">Insurance Amount</label>
                <input type="text" name='insuranceamount' class="form-control" id="insuranceamountid" placeholder="">
                    @error('insuranceamount')
                <div class="text-danger">{{$message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-group col-md-12 col-lg-12 col-xl-12">
              <label for="assetvalue">Asset Value</label>
              <input type="text" name='assetvalue' class="form-control" id="assetvalueid" placeholder="">
                  @error('assetvalue')
              <div class="text-danger">{{$message }}</div>
              @enderror
            </div>
            <div class="form-group col-md-12 col-lg-12 col-xl-12">
                  <label for="insurancetype">Insurance Type</label>
                  <select name="insurancetype" class="form-control">
                      <option value=''>Select Insurance Type</option>
                      <option value='private'>Private</option>
                      <option value="hired">Hired</option>
                  </select>
                </div>
            <div class="form-group col-md-12 col-lg-12 col-xl-12">
              <label for="coveringage">Covering Age</label>
              <input type="text" name='coveringage' class="form-control" id="coveringageid" placeholder="">
                  @error('coveringage')
              <div class="text-danger">{{$message }}</div>
              @enderror
            </div>
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                  <label for="startdate">Start Date</label>
                  <select name="startdate" class="form-control">
                   
                      <option value=''>Select date</option>
                      <option value='2/1/2022'>2/1/2022</option>
                      <option value="3/1/2022">3/1/2022</option>
                  </select>
                      
                  </select>
                </div>
                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                  <label for="enddate">End Date</label>
                  <select name="enddate" class="form-control">
                      <option value=''>Select date</option>
                      <option value='2/1/2022'>2/1/2022</option>
                      <option value="3/1/2022">3/1/2022</option>
                  </select>
                </div>
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
<!-- end of Add new insurance model -->
@endsection