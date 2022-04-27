@extends('layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Employee Salary Details</h4>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
        <table class="table table-striped" id="salaryListDatatable" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th class="col-sm-1">#</th>
                    <th class="col-sm-1">Employee ID</th>
                    <th>Name</th>
                    <th>Salary Type</th>
                    <th>Basic Salary</th>
                    <th>Over time
                        <small>(Per hourly)</small>
                    </th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
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
$(function() {
    let urlcontract = "{{ route('manage_salary.create') }}";
    $('#salaryListDatatable').DataTable({
        processing: false,
        serverSide: true,
        lengthChange: true,
        searching: true,
        type: 'GET',
        ajax: {
            url: urlcontract,
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'emp_id',
                name: 'emp_id'
            },
            {
                data: 'full_name',
                name: 'full_name'
            },
          
            {
                data: 'salary_type',
                name: 'salary_type'
            },
            {
                data: 'basic_salary',
                name: 'basic_salary'
            },
            {
                data: 'overtime_salary',
                name: 'overtime_salary'
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },

        ]
    })
});
</script>
@endsection