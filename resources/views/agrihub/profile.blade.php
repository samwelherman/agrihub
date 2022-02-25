@extends('layouts.master')

@section('content')
<section class="section">
    <div class="section-body">
      <div class="row mt-sm-4">
      
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="padding-20">
              <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                    aria-selected="true">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                    aria-selected="false">Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="farm land" data-toggle="tab" href="#settings" role="tab"
                      aria-selected="false">Farm land</a>
                  </li>
              </ul>
              <div class="tab-content tab-bordered" id="myTab3Content">
                
                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                  <div class="row">
                    <div class="col-md-3 col-lg-3 col-6 b-r">
                        <div class="author-box-center">
                            <img alt="image" src="{{asset('assets/img/logo.jpeg')}}" class="rounded-circle author-box-picture">
                             
                     
                        </div>
                    
                  </div>
                
                 <div class="col-md-9 col-lg-9 col-6 b-r">
                    <div class="row">     
                        
                        <div class="col-md-3 col-6 ">
                        </div>
                        <div class="col-md-6 col-6 ">
                        <strong>Fullname:</strong>
                        
                        <b> {{$farmer->firstname}} {{$farmer->lastname}} </b>
                        </div>
                    </div>
                    <div class="row">     
                    
                    <div class="col-md-3 col-6 ">
                    </div>
                    <div class="col-md-6 col-6 ">
                      <strong>Mobile: </strong>
                    
                       <b>{{$farmer->phone}} </b>
                    </div>
                    </div>
                        <div class="row">     
                        
                            <div class="col-md-3 col-6 ">
                            </div>
                            <div class="col-md-6 col-6 ">
                            <strong>Email: </strong>
                            
                            <b>{{$farmer->email}} </b>
                            </div>
                        </div>
                     
                        <div class="row">     
                        
                            <div class="col-md-3 col-6 ">
                            </div>
                            <div class="col-md-6 col-6 ">
                            <strong>Location: </strong>
                            
                            <b>{{$farmer->region}}, {{$farmer->address}}</b>
                            </div>
                        </div>

                        <div class="row">     
                        
                            <div class="col-md-3 col-6 ">
                            </div>
                            <div class="col-md-6 col-6 ">
                            <strong>Group: </strong>
                            
                            <b>{{$farmer->group->name}}</b>
                            </div>
                        </div>
                    </div>
                        
                  </div>
                  </div>
                
                <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                    <form class="form" method="post" action="{{url('farmer/update',$farmer->id)}}">
                        {{ csrf_field() }}
                          <div class="card-body">
                            <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputEmail4">FirstName</label>
                              <input type="text" name='firstname' value="{{$farmer->firstname}}" class="form-control" id="inputEmail4" placeholder="">
                                  @error('firstname')
                            <div class="text-danger">{{$message }}</div>
                        @enderror
                            </div>
                      
                            <div class="form-group col-md-6">
                              <label for="inputPassword4">LastName</label>
                              <input type="text" value="{{$farmer->lastname}}" name='lastname' class="form-control" id="inputPassword4" placeholder="">
                               @error('lastname')
                            <div class="text text-danger">{{$message }}</div>
                        @enderror
                            </div>
                        
                            </div>
                            <div class="form-row">
                             <div class="form-group col-md-6 col-lg-6">
                              <label for="inputAddress">Phone number</label>
                              <input type="text" name='phone' value="{{$farmer->phone}}" class="form-control" id="inputAddress" placeholder="">
                              @error('phone')
                              <div class="text text-danger">{{$message }}</div>
                          @enderror 
                            </div>
                              <div class="form-group col-md-6 col-lg-6">
                              <label for="inputAddress">Email</label>
                              <input type="email" name='email' value="{{$farmer->email}}" class="form-control" id="inputAddress" placeholder="example@example.com (optional)">
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputState">Region</label>
                                <select id="inputState" name="region" class="form-control">
                                
                                  <option value="mwanza"   @if('mwanza'==$farmer->region)
                                    selected
                                    
                                    @endif>Mwanza</option>
                                  <option value="dar-es-salaam"  @if('dar-es-salaam'==$farmer->region)
                                    selected
                                    
                                    @endif>Dar es salaam</option>
                                  <option value="iringa"  @if('iringa'==$farmer->region)
                                    selected
                                    
                                    @endif>Iringa</option>
                                  <option value="kigoma"  @if('kigoma'==$farmer->region)
                                    selected
                                    
                                    @endif>Kigoma</option>
                                  <option value="morogoro"   @if('morogoro'==$farmer->region)
                                    selected
                                    
                                    @endif>Morogoro</option>
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                <label for="inputCity">Physical Address</label>
                                <input type="text" name="address" value="{{$farmer->address}}" class="form-control" id="inputCity">
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
                                  @if(count($group)>0)
                                  @foreach($group as $group)
                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                  @endforeach
                                  @endif
                                  </select>
                                </div>
                                </div>
                
                          <div class="form-row">
                            <div class="form-group col-md-6 col-lg-6">
                    
                      <input type="submit" value="Update" name="save" class="btn btn-lg btn-primary">
                    </div>
                            </div></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection