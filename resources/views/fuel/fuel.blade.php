@extends('layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Fuel</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                         
                                <a class="nav-link @if(empty($id)) active show @endif" id="home-tab2" data-toggle="tab"
                                    href="#home2" role="tab" aria-controls="home" aria-selected="true">Fuel
                                    List</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link @if(!empty($id)) active show @endif" id="profile-tab2"
                                    data-toggle="tab" href="#profile2" role="tab" aria-controls="profile"
                                    aria-selected="false">New Fuel</a>
                            </li>
                           

                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade @if(empty($id)) active show @endif" id="home2" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <div class="table-responsive">
                               
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>

                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending"
                                                    style="width: 186.484px;">#</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending"
                                                    style="width: 186.484px;">Truck</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending"
                                                    style="width: 186.484px;">Route</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending"
                                                    style="width: 141.219px;">Fuel Rate</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending"
                                                    style="width: 141.219px;">Fuel Used</th>


                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending"
                                                    style="width: 98.1094px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!@empty($fuel))
                                            @foreach ($fuel as $row)
                                            <tr class="gradeA even" role="row">

                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>{{$row->truck->truck_name}}</td>
                                                <td>From {{$row->route->from}} to {{$row->route->to}}</td>

                                                <td>{{$row->fuel_rate}}</td>
                                                <td> <a href="#view{{$row->id}}" data-toggle="modal">{{$row->fuel_used}} Litres</a></td>

                                                <td>
                                                    @if($row->due_fuel != 0 && $row->status_approve != 1 )
                                                    <a class="btn btn-xs btn-outline-info text-uppercase px-2 rounded"
                                                        title="Edit" onclick="return confirm('Are you sure?')"
                                                        href="{{ route('fuel.edit', $row->id)}}"><i
                                                            class="fa fa-edit"></i></a>
                                                            @endif

                                                    {!! Form::open(['route' => ['fuel.destroy',$row->id],
                                                    'method' => 'delete']) !!}
                                                    {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-outline-danger text-uppercase px-2 rounded demo4', 'title' => 'Delete', 'onclick' => "return confirm('Are you sure?')"]) }}
                                                    {{ Form::close() }}

                                                     @if($row->due_fuel != 0 || $row->status_approve != 1 )
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-success dropdown-toggle"
                                                            data-toggle="dropdown">Change<span
                                                                class="caret"></span></button>
                                                        <ul class="dropdown-menu animated zoomIn">
                                                            @if($row->due_fuel != 0 )
                                                            <li class="nav-item"><a class="nav-link"
                                                                    title="Refill Fuel"
                                                                    data-toggle="modal"  href="#" data-target="#appFormModal"
                                            data-id="{{ $row->id }}" data-type="refill"
                                            onclick="model({{ $row->id }},'refill')">Refill Fuel
                                                                  </a></li>
                                                                  @endif

                                                                  @if($row->status_approve != 1 )
                                                                  
                                                            <li class="nav-item"><a class="nav-link" title="Adjustment Fuel"
                                                                data-toggle="modal" href=""  value="{{ $row->id}}" data-type="adjustment" data-target="#appFormModal"
                                                                onclick="model({{ $row->id }},'adjustment')">Adjustment Fuel
                                                                    </a></li>                          
                                                                    @endif

                                                                    @if($row->fuel_adjustment != '' && $row->status_approve != 1 )
                                                                    <li class="nav-item"><a class="nav-link" id="profile-tab2"
                                                                        href="{{ route('fuel.approve',$row->id)}}"
                                                                        role="tab"
                                                                        aria-selected="false" onclick="return confirm('Are you sure?')">Approve Adjustment Fuel
                                                                            </a></li>
                                                                            @endif
                                                        </ul>
                                                    </div>
                                                    @endif

                                                </td>
                                            </tr>
                                            @endforeach

                                            @endif

                                        </tbody>
                                    </table>
                                   
                                </div>

                            </div>
                            <div class="tab-pane fade @if(!empty($id)) active show @endif" id="profile2" role="tabpanel"
                                aria-labelledby="profile-tab2">

                                <div class="card">
                                    <div class="card-header">
                                        @if(empty($id))
                                        <h5>Create Fuel</h5>
                                        @else
                                        <h5>Edit Fuel</h5>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 ">
                                                @if(isset($id))
                                                {{ Form::model($id, array('route' => array('fuel.update', $id), 'method' => 'PUT')) }}
                                                @else
                                                {{ Form::open(['route' => 'fuel.store']) }}
                                                @method('POST')
                                                @endif




                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-form-label">Truck</label>
                                                    <div class="col-lg-4">
                                                        <select class="form-control" name="truck_id" required
                                                        id="supplier_id">
                                                        <option value="">Select</option>
                                                        @if(!empty($truck))
                                                        @foreach($truck as $row)

                                                        <option @if(isset($data))
                                                            {{  $data->truck_id == $row->id  ? 'selected' : ''}}
                                                            @endif value="{{ $row->id}}">{{$row->truck_name}}</option>

                                                        @endforeach
                                                        @endif

                                                    </select>
                                                    </div>
                                                    <label class="col-lg-2 col-form-label">Route</label>
                                                    <div class="col-lg-4">
                                                        <div class="input-group">
                                                            <select class="form-control" name="route_id" required
                                                                id="route">
                                                                <option value="">Select</option>
                                                                @if(!empty($route))
                                                                @foreach($route as $row)

                                                                <option @if(isset($data))
                                                                    {{  $data->route_id == $row->id  ? 'selected' : ''}}
                                                                    @endif value="{{ $row->id}}">From {{$row->from}} to  {{$row->to}}</option>

                                                                @endforeach
                                                                @endif

                                                            </select>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-primary" type="button"
                                                                    data-toggle="modal" href="routeModal"  
                                                                    data-target="#routeModal"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-2 col-form-label">Fuel Rate</label>
                                                    <div class="col-lg-4">
                                                        <input type="number" name="fuel_rate"
                                                            placeholder=""
                                                            value="{{ isset($data) ? $data->fuel_rate : ''}}"
                                                            class="form-control">
                                                    </div>
                                                   
                                                </div>


                                                
                                                <div class="form-group row">
                                                    <div class="col-lg-offset-2 col-lg-12">
                                                        @if(!@empty($id))

                                                        <a class="btn btn-sm btn-danger float-right m-t-n-xs"
                                                            href="{{ route('fuel.index')}}">
                                                           Cancel
                                                        </a>
                                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs"
                                                            data-toggle="modal" data-target="#myModal"
                                                            type="submit">Update</button>
                                                        @else
                                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs"
                                                            type="submit">Save</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
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

@if(!empty($refill))
@foreach($refill as $row)
<!-- Modal -->
<div class="modal inmodal " id="view{{$row->fuel_id}}"  tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog" role="document">
<div class="modal-content">
   <div class="modal-header">
       <h5 class="modal-title"  style="text-align:center;"> 
         Fuel Refill 
            @php    
            $truck=App\Models\Truck::where('id', $row->truck)->get();   
          @endphp
             @foreach($truck as $t)
             For {{$t->truck_name}} 
            @endforeach

            @php    
            $route=App\Models\Route::where('id', $row->route)->get();   
          @endphp
             @foreach($route as $r)
            with Route {{$r->from}} - {{$r->to}}
            @endforeach
        </td>
        <h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
       </button>
   </div>


   <div class="modal-body">
<div class="table-responsive">
                       <table class="table table-bordered table-striped">
<thead>
               <tr>
                <th>#</th>

                       <th>Refill</th>
                   <th>Price per Litre</th>
                   <th>Total Cost</th>
               </tr>
               </thead>

               <?php
                        $total_l=0; 
                   $total_c=0;    

                        $history = \App\Models\Fuel\Refill::where('fuel_id', $row->fuel_id)->get();                                               
?>

<tbody>   
    @foreach($history as $h)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                               
                    <td >{{$h->litres }} Litres</td>
                   <td>{{number_format($h->price,2) }}</td>                  
                   <td>{{number_format($h->total_cost,2) }} </td>

                   @php    
                   $total_l+=$h->litres; 
                   $total_c+=$h->total_cost;   
                 @endphp
                   
               </tr> 
               @endforeach

                   </tbody>

                   <tfoot>
                 
                    <td><b>Total</b></td>
                  
                    
        <td >{{number_format($total_l,2)}} Litres</td>
       <td></td>                  
       <td>{{number_format($total_c,2) }} </td>

   </tr> 

                   </tfoot>
                       </table>
                      </div>

   </div>
  
</div>
</div></div>
</div>

@endforeach
@endif

<!-- discount Modal -->
<div class="modal inmodal show" id="appFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    </div>
</div>
</div>
</div>


<!-- route Modal -->
<div class="modal inmodal show" id="routeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Add Route</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Make sure you enter valid information</strong> .</p>

                    
                  
                    <div class="form-group row"><label class="col-lg-2 col-form-label">From</label>

                        <div class="col-lg-10">
                            <input type="text" name="from" id="from" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row"><label class="col-lg-2 col-form-label">To</label>

                        <div class="col-lg-10">
                            <input type="text" name="to" id="to" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row"><label class="col-lg-2 col-form-label">Distance(km)</label>

                        <div class="col-lg-10">
                            <input type="number" name="distance" id="distance" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary route">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.dataTables-example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [{
                extend: 'copy'
            },
            {
                extend: 'csv'
            },
            {
                extend: 'excel',
                title: 'ExampleFile'
            },
            {
                extend: 'pdf',
                title: 'ExampleFile'
            },

            {
                extend: 'print',
                customize: function(win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }
        ]

    });

});
</script>

<script>
    $(document).ready(function(){
      
     

 $(document).on('click', '.route', function(){

    var to = $('#to').val();
     var distance = $('#distance').val();
     var from = $('#from').val();


        $.ajax({
            type: 'GET',
            url: '{{url("addRoute")}}',
            data: {
                 'to':to,
                 'distance':distance,
                 'from':from,
             },
            cache: false,
            async: true,
            success: function(response) {

console.log( response);
                             var id = response[0]["id"];
                             
                             var arrival_point = response[0]["from"];
                              var destination_point =response[0]["to"];

                             var option = "<option value='"+id+"'>From "+from+" to "+to+"</option>"; 

                             $("#route").append(option);
                              $('#routeModal').hide();
                    
        },
        error: function() {
            alert('Error');
        }



        });

});


    });
</script>

<script src="{{ url('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

<script type="text/javascript">
    function model(id,type) {

$.ajax({
    type: 'GET',
    url: '{{url("discountModal")}}',
    data: {
        'id': id,
        'type':type,
    },
    cache: false,
    async: true,
    success: function(data) {
        //alert(data);
        $('.modal-dialog').html(data);
    },
    error: function(error) {
        $('#appFormModal').modal('toggle');

    }
});

}


function calculateDiscount() {

$('#price,#litres').on('input',function() {
var price= parseInt($('#price').val());
var qty = parseFloat($('#litres').val());
console.log(price);
$('#total_cost').val((qty* price ? qty * price : 0).toFixed(2));
});

}
    
    </script>




@endsection