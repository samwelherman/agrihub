@extends('layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Deposit</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if(empty($id)) active show @endif" id="home-tab2" data-toggle="tab"
                                    href="#home2" role="tab" aria-controls="home" aria-selected="true">Deposit
                                    List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(!empty($id)) active show @endif" id="profile-tab2"
                                    data-toggle="tab" href="#profile2" role="tab" aria-controls="profile"
                                    aria-selected="false">New Deposit</a>
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
                                                    aria-label="Browser: activate to sort column ascending"
                                                    style="width: 208.531px;">#</th>

                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending"
                                                    style="width: 186.484px;">Deposit Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending"
                                                    style="width: 186.484px;">Deposit Account</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending"
                                                    style="width: 141.219px;">Payment Account</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending"
                                                    style="width: 141.219px;">Amount</th>
                                                      <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending"
                                                    style="width: 98.1094px;">Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending"
                                                    style="width: 98.1094px;">Actions</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @if(!@empty($deposit))
                                            @foreach ($deposit as $row)
                                            <tr class="gradeA even" role="row">
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{$row->name}}</td>
                                                    @php
                                                 $account=App\Models\AccountCodes::where('id',$row->account_id)->first();
                                                @endphp
                                                <td>{{$account->account_name}}</td>
                                                      @php
                                                 $bank=App\Models\AccountCodes::where('id',$row->bank_id)->first();
                                                @endphp
                                                <td>{{$bank->account_name}}</td>                                           
                                                  <td>{{number_format($row->amount,2)}}</td>
                                                   <td>{{$row->date}}</td>

                                                <td>
                                                    <div class="row">
                                                       
                                                        <div class="col-lg-6">
<a class="btn btn-icon btn-info" title="Edit" onclick="return confirm('Are you sure?')"   href="{{ route("deposit.edit", $row->id)}}"><i class="fa fa-edit"></i></a>
                                                        </div>
                                                     
                                                        <div class="col-lg-6">
                                                            {!! Form::open(['route' => ['deposit.destroy',$row->id], 'method' => 'delete']) !!}
                                                            {{ Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-icon btn-danger', 'onclick' => "return confirm('Are you sure?')"]) }}
                                                            {{ Form::close() }}
                                                        </div>
                                                     
                                                    </div>
                                                  

                                             

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
                                        <h5>Create Deposit</h5>
                                        @else
                                        <h5>Edit Deposit</h5>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 ">
                                                @if(isset($id))
                                                {{ Form::model($id, array('route' => array('deposit.update', $id), 'method' => 'PUT')) }}
                                                @else
                                                {{ Form::open(['route' => 'deposit.store']) }}
                                                @method('POST')
                                                @endif



                                                <div class="form-group row">
                           <label class="col-lg-2 col-form-label">Deposit Name/Title</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" name="name" 
                                                            value="{{ isset($data) ? $data->name : ''}}"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                               <div class="form-group row">
                                                    <label class="col-lg-2 col-form-label">Amount</label>
                                                    <div class="col-lg-8">
                                                        <input type="number" name="amount" required
                                                            placeholder=""
                                                            value="{{ isset($data) ? $data->amount : ''}}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                  <div class="form-group row">
                                                    <label class="col-lg-2 col-form-label">Date</label>
                                                    <div class="col-lg-8">
                                                        <input type="date" name="date" required
                                                            placeholder=""
                                                            value="{{ isset($data) ? $data->date: ''}}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group row"><label
                                                        class="col-lg-2 col-form-label">Deposit Account</label>
                                                    <div class="col-lg-8">
                                                <select class="form-control" name="account_id" required>
                                                    <option value="">Select Deposit Account</option>                                                    
                                                            @foreach ($chart_of_accounts as $chart)                                                             
                                                            <option value="{{$chart->id}}" @if(isset($data))@if($data->account_id == $chart->id) selected @endif @endif >{{$chart->account_name}}</option>
                                                               @endforeach
                                                             </select>
                                                    </div>
                                                </div>

                                                   <div class="form-group row"><label
                                                        class="col-lg-2 col-form-label">Bank/Cash Account</label>
                                                    <div class="col-lg-8">
                                                       <select class="form-control" name="bank_id" required>
                                                    <option value="">Select Payment Account</option> 
                                                          @foreach ($bank_accounts as $bank)                                                             
                                                            <option value="{{$bank->id}}" @if(isset($data))@if($data->bank_id == $bank->id) selected @endif @endif >{{$bank->account_name}}</option>
                                                               @endforeach
                                                              </select>
                                                    </div>
                                                </div>
                                              
                                                  <div class="form-group row">
                                                    <label class="col-lg-2 col-form-label">Notes</label>
                                                    <div class="col-lg-8">
                                                        <textarea name="notes"
                                                            placeholder=""
                                                            class="form-control" rows="2"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-lg-offset-2 col-lg-12">
                                                        @if(!@empty($id))
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
<script src="{{ url('assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

@endsection