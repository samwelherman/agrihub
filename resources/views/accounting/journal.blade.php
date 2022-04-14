@extends('layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Journal Entry Report</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link @if(empty($id)) active show @endif" id="home-tab2" data-toggle="tab"
                                    href="#home2" role="tab" aria-controls="home" aria-selected="true">Journal Entry Report
                                    List</a>
                            </li>
                       

                        </ul>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade @if(empty($id)) active show @endif" id="home2" role="tabpanel"
                                aria-labelledby="home-tab2">

<br>
        <div class="panel-heading">
            <h6 class="panel-title">
                Journal Entries 
                @if(!empty($start_date))
                    for the period: <b>{{$start_date}} to {{$end_date}}</b>
                @endif
            </h6>
        </div>

<br>
        <div class="panel-body hidden-print">
            {!! Form::open(array('url' => Request::url(), 'method' => 'post','class'=>'form-horizontal', 'name' => 'form')) !!}
            <div class="row">

                <div class="col-md-4">
                    <label class="">Start Date</label>
                    {!! Form::date('start_date',$start_date, array('class' => 'form-control date-picker', 'placeholder'=>"",'required'=>'required')) !!}
                </div>
                <div class="col-md-4">
                    <label class="">End Date</label>
                    {!! Form::date('end_date',$end_date, array('class' => 'form-control date-picker', 'placeholder'=>"",'required'=>'required')) !!}
                </div>
                <div class="col-md-4">
                    <label class="">Chart of Accounts</label>
                    {!! Form::select('account_id',$chart_of_accounts,$account_id, array('class' => 'form-control select2', 'placeholder'=>'Select','required'=>'required')) !!}
                </div>

   <div class="col-md-4">
                      <br><button type="submit" class="btn btn-success">Search</button>
                        <a href="{{Request::url()}}"class="btn btn-danger">Reset</a>

                </div>                  
                </div>
           
            {!! Form::close() !!}

        </div>

        <!-- /.panel-body -->

   <br>
@if(!empty($start_date))
        <div class="panel panel-white">
            <div class="panel-body ">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Transaction Type</th>
                            <th>Date</th>
                            <th>Account Name</th>
                            <th>Debit</th>
                            <th>Credit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$key->transaction_type}}</td>
                                <td>{{ $key->date }}</td>
                                <td>
                                    @if(!empty($key->chart))
                                        {{ $key->chart->name }}
                                    @endif
                                </td>
                                 
                                <td>{{ number_format($key->debit,2) }}</td>
                                <td>{{ number_format($key->credit,2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.panel-body -->
             </div>
    @endif              

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