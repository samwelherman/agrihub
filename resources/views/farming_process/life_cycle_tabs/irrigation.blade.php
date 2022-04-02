<div class="tab-pane fade @if($type =='irrigation' || $type =='edit-irrigation') active show  @endif" id="irrigation"
    role="tabpanel" aria-labelledby="irrigation">
    <div class="card">
        <div class="card-header">
            <h4>{{__('farming.irrigation')}}</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
              
                <li class="nav-item">
                    <a class="nav-link @if($type =='edit-irrigation') active show @endif" id="profile-tab5"
                        data-toggle="tab" href="#profile6" role="tab" aria-controls="profile5"
                        onclick="{ $type = 'edit-irrigation'}"
                        aria-selected="false">{{__('farming.irrigation_setting')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($type =='edit-irrigation') active show @endif" id="profile-tab6"
                        data-toggle="tab" href="#profile7" role="tab" aria-controls="profile6"
                        onclick="{ $type = 'process'}" aria-selected="false">{{__('farming.irrigation_process')}}</a>
                </li>

            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
                
                <div class="tab-pane fade @if($type =='irrigation') active show @endif" id="profile7" role="tabpanel"
                    aria-labelledby="home-tab6">
                    <button type="button" class="btn btn-outline-info btn-xs px-4" data-toggle="modal"
                        onclick="model(1,'add2')" data-target="#appFormModal">
                        <i class="fa fa-plus-circle"></i>
                        Add2
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="processDatatable">
                            <thead>
                                <tr>
                                    <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">#.No
                                    </th>
                                    <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                        {{__('farming.irrigation_date')}}</th>
                                    <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                        {{__('farming.water_volume')}}</th>
                                    <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                        {{__('farming.next_date')}}</th>
                                    <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                        {{__('farming.cost_per_heck')}}</th>
                                    <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                        {{__('farming.no_of_heck')}}</th>
                                    <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                        {{__('farming.total_volume')}}</th>

                                    <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                        {{__('farming.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade @if($type =='process') active show @endif" id="profile6" role="tabpanel"
                    aria-labelledby="profile-tab5">
                    <div class="card">
                        <div class="card-header">

                            <h5>{{__('farming.irrigation_setting')}}</h5>
                            <button type="button" class="btn btn-outline-info btn-xs px-4" data-toggle="modal"
                                onclick="model(1,'add')" data-target="#appFormModal">
                                <i class="fa fa-plus-circle"></i>
                                Add
                            </button>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="settingDatatable">
                                    <thead>
                                        <tr>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">#.No
                                            </th>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                                {{__('farming.irrigation_type')}}</th>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                                {{__('farming.irrigation_cost')}}</th>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                                {{__('farming.number_of_hk')}}</th>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                                {{__('farming.water_volume')}}</th>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                                {{__('farming.total_cost')}}</th>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                                {{__('farming.power_source')}}</th>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                                {{__('farming.pump_cost')}}</th>
                                            <th class="sorting" rowspan="1" colspan="1" style="width: 141.219px;">
                                                {{__('farming.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div class="table-responsive">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade @if($type =='edit-irrigation_process') active show @endif"
                            id="profile7" role="tabpanel" aria-labelledby="profile-tab7">

                            <div class="card">
                                <div class="card-header">

                                    <h5>{{__('farming.irrigation_process')}}</h5>
                                    <button type="button" class="btn btn-outline-info btn-xs px-4" data-toggle="modal"
                                        onclick="model(1,'add2')" data-target="#appFormModal">
                                        <i class="fa fa-plus-circle"></i>
                                        Add2
                                    </button>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="processDatatable">
                                            <thead>
                                                <tr>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">#.No</th>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">
                                                        {{__('farming.irrigation_type')}}</th>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">
                                                        {{__('farming.irrigation_cost')}}</th>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">
                                                        {{__('farming.number_of_hk')}}</th>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">
                                                        {{__('farming.water_volume')}}</th>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">
                                                        {{__('farming.total_cost')}}</th>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">
                                                        {{__('farming.power_source')}}</th>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">
                                                        {{__('farming.pump_cost')}}</th>
                                                    <th class="sorting" rowspan="1" colspan="1"
                                                        style="width: 141.219px;">
                                                        {{__('farming.action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <div class="table-responsive">
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>

                <script>
                $(document).ready(function() {

                    $(document).on('click', '.remove', function() {
                        $(this).closest('tr').remove();
                    });

                    $(document).on('change', '.item_name', function() {
                        var id = $(this).val();
                        var sub_category_id = $(this).data('sub_category_id');
                        $.ajax({
                            url: '/courier/public/findPrice/',
                            type: "GET",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(data) {
                                console.log(data);
                                $('.item_price' + sub_category_id).val(data[0][
                                    "price"
                                ]);
                                $(".item_unit" + sub_category_id).val(data[0]["unit"]);
                                $(".item_saved" + sub_category_id).val(data[0]["id"]);
                            }

                        });

                    });


                });
                </script>



                <script type="text/javascript">
                $(function() {
                    let urlcontract = "{{ route('irrigation.index') }}";
                    $('#settingDatatable').DataTable({
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
                                data: 'irrigation_type',
                                name: 'irrigation_type'
                            },
                            {
                                data: 'irrigation_cost',
                                name: 'irrigation_cost'
                            },
                            {
                                data: 'number_of_hk',
                                name: 'number_of_hk'
                            },
                            {
                                data: 'water_volume',
                                name: 'water_volume'
                            },
                            {
                                data: 'power_source',
                                name: 'power_source',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'pump_cost',
                                name: 'pump_cost',
                                orderable: true,
                                searchable: true
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

                $(function() {
                    let urlcontract = "{{ route('irrigation.create') }}";
                    $('#processDatatable').DataTable({
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
                                data: 'irrigation_date',
                                name: 'irrigation_date'
                            },
                            {
                                data: 'water_volume',
                                name: 'water_volume'
                            },
                            {
                                data: 'next_date',
                                name: 'next_date'
                            },
                            {
                                data: 'cost_per_heck',
                                name: 'cost_per_heck'
                            },
                            {
                                data: 'no_of_heck',
                                name: 'no_of_heck',
                                orderable: true,
                                searchable: true
                            },
                            {
                                data: 'total_volume',
                                name: 'total_volume',
                                orderable: true,
                                searchable: true
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

                function model(id, type1) {
                    let url = '{{ route("irrigation.show", ":id") }}';
                    url = url.replace(':id', id)
                    $.ajax({
                        type: 'GET',
                        url: url,
                        data: {
                            'id': id,
                            'type': type1,
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

                function saveIrrigation(e) {
                    let url = "{{ route('irrigation.store') }}";
                    let form = $(e).closest('form');
                    let formID = '#' + form.attr('id');
                    let formElement = $(formID);
                    type = document. getElementById('type');
                    var form1 = $('form')[0];

                    let modal = $('#appFormModal');
                    let loading = $('.ibox-loading');
                    modal.find('.modal-content').addClass('d-none').removeClass('d-block');
                    loading.removeClass('d-none').addClass('d-block');
                    loading.children('.ibox-content').toggleClass('sk-loading');


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: 'POST',
                        data: {'type':12},
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            let oTable = $('#settingDatatable').dataTable()
                            oTable.fnDraw(false)
                            modal.html("")
                            modal.modal('toggle')
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            })
                            Toast.fire({
                                type: 'success',
                                title: 'Information added successffully. '
                            })
                        },
                        error: function(error) {
                            modal.find('.modal-content-div').addClass('d-block').removeClass('d-none');
                            loading.children('.ibox-content').toggleClass('sk-loading');
                            loading.addClass('d-none').removeClass('d-block');

                            if (error.status === 422) {
                                let errorsJson = error.responseJSON.errors
                                let errorString = ''
                                Object.values(errorsJson).forEach(e => errorString += e[0] + '<br>')
                                $('.errors').removeClass('d-none').addClass('d-block')
                                    .html(errorString);
                            }
                            if (error.status === 423) {
                                let errorsJson = error.responseJSON.errors
                                let errorString = ''
                                Object.values(errorsJson).forEach(e => errorString += e[0] + '<br>')
                                $('.errors').removeClass('d-none').addClass('d-block')
                                    .html(errorString);
                            }

                            console.log(error);
                        }
                    })
                }

                function saveProcess(e) {
                    let url = "{{ route('irrigation.store') }}";
                    let form = $(e).closest('form');
                    let formID = '#' + form.attr('id');
                    let formElement = $(formID);

                    var form1 = $('form')[0];

                    let modal = $('#appFormModal');
                    let loading = $('.ibox-loading');
                    modal.find('.modal-content').addClass('d-none').removeClass('d-block');
                    loading.removeClass('d-none').addClass('d-block');
                    loading.children('.ibox-content').toggleClass('sk-loading');


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        type: 'POST',
                        data: new FormData(e.target),
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            let oTable = $('#processDatatable').dataTable()
                            oTable.fnDraw(false)
                            modal.html("")
                            modal.modal('toggle')
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            })
                            Toast.fire({
                                type: 'success',
                                title: 'Information added successffully. '
                            })
                        },
                        error: function(error) {
                            modal.find('.modal-content-div').addClass('d-block').removeClass('d-none');
                            loading.children('.ibox-content').toggleClass('sk-loading');
                            loading.addClass('d-none').removeClass('d-block');

                            if (error.status === 422) {
                                let errorsJson = error.responseJSON.errors
                                let errorString = ''
                                Object.values(errorsJson).forEach(e => errorString += e[0] + '<br>')
                                $('.errors').removeClass('d-none').addClass('d-block')
                                    .html(errorString);
                            }
                            if (error.status === 423) {
                                let errorsJson = error.responseJSON.errors
                                let errorString = ''
                                Object.values(errorsJson).forEach(e => errorString += e[0] + '<br>')
                                $('.errors').removeClass('d-none').addClass('d-block')
                                    .html(errorString);
                            }

                            console.log(error);
                        }
                    })
                }
                </script>
            </div>