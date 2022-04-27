

           

<div class="" id="test">
     <div class="form-group" >
                <label class="col-lg-6 col-form-label">Truck </label>

                <div class="col-lg-12">
                    <select class="form-control truck_id" name="truck_id"  id="truck" required>
                                                      
                                                        <option value="">Select Truck</option>
                                                                        @if(!empty($truck))
                                                        @foreach($truck as $row)

                                                        <option @if(isset($data))
                                                            {{  $data->truck_id == $row->id  ? 'selected' : ''}}
                                                            @endif value="{{ $row->id}}">{{$row->reg_no}} </option>

                                                        @endforeach
                                                        @endif


                                                    </select>
                </div>
            </div>

 <div class="form-group">
                <label class="col-lg-6 col-form-label">Driver</label>

                <div class="col-lg-12">
                    <select class="form-control driver_id" name="driver_id" id="driver" required>
                                                      
                                                        <option value="">Select Driver</option>
                                                       
                                                         @if(!empty($driver))
                                                        @foreach($driver as $row)

                                                        <option @if(isset($data))
                                                            {{  $data->driver_id == $row->id  ? 'selected' : ''}}
                                                            @endif value="{{ $row->id}}">{{$row->driver_name}} </option>

                                                        @endforeach
                                                        @endif

                                                    </select>
                </div>
            </div>
        

        </div>
      
