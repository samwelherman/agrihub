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
              <h4>Register Assets</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-12 col-lg-2 col-xl-2 col-md-2">
                  <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                     <li class="nav-item">
                      <a class="nav-link  active" id="profile-tab4" data-toggle="tab" href="#profile4" role="tab" aria-controls="profile" aria-selected="true">Manage Farmer</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="home" aria-selected="false">Register </a>
                    </li>
                   
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                  </ul>
                </div>
                
                <div class="col-12 col-sm-12 col-lg-10 col-xl-10 col-md-10">
                  <div class="tab-content no-padding" id="myTab2Content">
                    <div class="tab-pane fade" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                      <div class="card">
                        <div class="card-header">
                          <h4>Farmer Management</h4>
                        </div>
                        <div class="card-body p-0">
                          <form class="form" method="post" action="{{url('farmer/save')}}">
                            {{ csrf_field() }}
                              <div class="card-body">
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputEmail4">FirstName</label>
                                  <input type="text" name='firstname' class="form-control" id="inputEmail4" placeholder="">
                                      @error('firstname')
                                <div class="text-danger">{{$message }}</div>
                            @enderror
                                </div>
                          
                                <div class="form-group col-md-6">
                                  <label for="inputPassword4">LastName</label>
                                  <input type="text" name='lastname' class="form-control" id="inputPassword4" placeholder="">
                                   @error('lastname')
                                <div class="text text-danger">{{$message }}</div>
                            @enderror
                                </div>
                            
                                </div>
                                <div class="form-row">
                                 <div class="form-group col-md-6 col-lg-6">
                                  <label for="inputAddress">Phone number</label>
                                  <input type="text" name='phone' class="form-control" id="inputAddress" placeholder="">
                                  @error('phone')
                                  <div class="text text-danger">{{$message }}</div>
                              @enderror 
                                </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                  <label for="inputAddress">Email</label>
                                  <input type="email" name='email' class="form-control" id="inputAddress" placeholder="example@example.com (optional)">
                                  </div>
                                </div>
                                <div class="form-row">
                                  <div class="form-group col-md-6">
                                    <label for="inputState">Region</label>
                                    <select id="inputState" name="region" class="form-control">
                                      <option selected="">Select region</option>
                                      <option value="mwanza">Mwanza</option>
                                      <option value="dar-es-salaam">Dar es salaam</option>
                                      <option value="iringa">Iringa</option>
                                      <option value="kigoma">Kigoma</option>
                                      <option value="morogoro">Morogoro</option>
                                    </select>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="inputCity">Physical Address</label>
                                    <input type="text" name="address" class="form-control" id="inputCity">
                                    @error('address')
                                    <div class="text text-danger">{{$message }}</div>
                                @enderror
                                  </div>
                                </div>  
                                <div class="form-row">
                                  <div class="form-group col-md-12 col-lg-12 col-sm-12">
                                    <label for="inputState">Group</label>
                                    <select id="inputState" name="group" class="form-control">
                                      <option value="0" selected="">Select group</option>
                                    @if(isset($group))
                                    @foreach($group as $group)
                                      <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                    @endif
                                    </select>
                                  </div>
                                  </div>
                                <!--
                                <div class="form-row">
                                  <div class="form-group col-md-6 col-lg-6">
                                  <label for="inputState">Region</label>
                                  <select id="inputState" class="form-control">
                                  <option selected="">Choose...</option>
                                  <option>...</option>
                                  </select>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                  <label for="inputCity">Physical Address</label>
                                  <input type="text" class="form-control" id="inputCity">
                                  </div>
                                </div>
                              -->
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
                      @if(count($farmer)>0)
                            <table class="table table-striped table-md">
                              <tbody><tr>
                          
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                            
                                <th>Address</th>
                                <th>Action</th>
                              </tr>
                              
                              @foreach($farmer as $flist)
                                 <tr>
                                   <td>{{$flist->firstname}} {{$flist->lastname}}</td>
                                <td>{{$flist->phone}}</td>
                                <td>{{$flist->email}}</td>
                                
                                <td> {{$flist->region}}, {{$flist->address}}</td>
                                <td>
                                  <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12">
                                  <a href="farmer/{{$flist->id}}/show" ><i class="fas fa-tv"></i></a>
                                  <a href="farmer/{{$flist->id}}/edit"><i class="fas fa-edit"></i></a>
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
@endsection