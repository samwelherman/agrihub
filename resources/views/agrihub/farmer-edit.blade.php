@extends('layouts.master')

@section('content')

  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>2 Column</h4>
            </div>
            <div class="card-body">
              <div class="row">
               
                <div class="col-12 col-sm-12 col-lg-10 col-xl-10 col-md-10">
                 
                    
                     
                        <div class="card-body p-0">
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
                                    <select id="inputState" name="group_id" class="form-control">
                                      <option value="0" selected="">Select group</option>
                                    @if(count($group)>0)
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
    </div>
  </section>
@endsection