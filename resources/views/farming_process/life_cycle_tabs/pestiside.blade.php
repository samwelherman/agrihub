<div class="tab-pane fade @if($type =='pestiside' || $type =='edit-pestiside') active show  @endif" id="pestiside"
    role="tabpanel" aria-labelledby="pestiside">
    <div class="card">
        <div class="card-header">
            <h4>{{__('farming.pestiside')}}</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if($type =='pestiside')active show @endif" id="home-tab4" data-toggle="tab"
                        href="#home11" role="tab4" aria-controls="home11" onclick="{ $type = 'pestiside'}"
                        aria-selected="true">{{__('farming.pestiside')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($type =='edit-pestiside') active show @endif" id="profile-tab4"
                        data-toggle="tab" href="#profile11" role="tab" aria-controls="profile"
                        onclick="{ $type = 'edit-pestiside'}" aria-selected="false">{{__('farming.new_pestiside')}}</a>
                </li>

            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade @if($type =='pestiside') active show @endif" id="home11" role="tabpanel"
                    aria-labelledby="home-tab4">
                    <div class="table-responsive">
                        <table class="table table-striped col-lg-12 col-sm-12" id="table-1">
                            <thead>
                                <tr role="row">


                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.pestiside_type')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.farming_process')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.pestiside_amount')}}</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.no_hector')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.total_amount')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.pestiside_price')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                        style="width: 98.1094px;">{{__('farming.total_costing')}}</th>
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                        style="width: 98.1094px;">{{__('farming.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!@empty($pestiside))
                                @foreach ($pestiside as $row)
                                <tr class="gradeA even" role="row">
                                    <td>{{$row->pestiside_type}}</td>
                                    <td>{{$row->farming_processes->process_name}}</td>
                                    <td>{{$row->pestiside_amount}}</td>
                                    <td>{{$row->no_hector}}</td>

                                    <td>{{$row->total_amount}}</td>
                                    <td>{{$row->pestiside_price}}</td>
                                    <td>{{$row->pestiside_cost}}</td>


                                    <td>

                                        <a class="btn btn-xs btn-outline-info text-uppercase px-2 rounded"
                                            href="{{ route('editLifeCycle',['id'=> $row->id,'type'=>'preparation','seasson_id'=>$seasson_id])}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-outline-danger text-uppercase px-2 rounded demo4"
                                            href="{{ route('seasson.destroy', $row->id)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <div class="btn-group">
                                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                                data-toggle="dropdown">Change<span
                                                                    class="caret"></span></button>
                                                            <ul class="dropdown-menu animated zoomIn">
                                                                <li class="nav-item"><a class="nav-link"
                                                                        title="quotation"
                                                                        href="{{ route('seasson.show', $row->id)}}">
                                                                        {{__('farming.crop_monitoring')}}</a></li>
                                                            </ul>
                                                        </div>

                                    </td>
                                </tr>
                                @endforeach

                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade @if($type =='edit-pestiside') active show @endif" id="profile11" role="tabpanel"
                    aria-labelledby="profile-tab4">

                    <div class="card">
                        <div class="card-header">
                            @if(!empty($id))
                            <h5>{{__('farming.pestiside')}}</h5>
                            @else
                            <h5>{{__('farming.new_pestiside')}}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 ">
                                @if($type =='edit-pestiside')
                                    {{ Form::model($id, array('route' => array('cropslifecycle.update', $id), 'method' => 'PUT')) }}
                                    @else
                                    {{ Form::open(['route' => 'cropslifecycle.store']) }}
                                    @method('POST')
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="hidden" name="type" class="form-control" id="type"
                                                value="pestiside" placeholder="">
                                                <input type="hidden" name="seasson_id" class="form-control" id="type"
                                                value="{{$seasson_id}}" placeholder="">
                                            <label for="inputEmail4">{{__('farming.pestiside_type')}}</label>
                                            <select class="form-control" name="pestiside_type" required>
                                                <option value="Insect">Insect </option>
                                                <option value="Plants">Plants </option>
                                                <option value="Batercides">Batercides</option>
                                                <option value="Fungicides">Fungicides</option>
                                                <option value="Lavercides">Lavercides </option>
                                                <option value="Rodenticides">Rodenticides </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.farming_process')}}</label>
                                            <?php
                                           $farming = App\Models\Farming_process::all();
                                            ?>
                                            <select class="form-control" name="farming_process" required>
                                                @if(!empty($farming))
                                                @foreach($farming as $row)
                                                <option value="{{$row->id}}">{{$row->process_name}} </option>
                                                @endforeach
                                                @endif
                                                

                                            </select>

                                        </div>


                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label for="inputEmail4">{{__('farming.pestiside_amount')}}</label>
                                            <input type="number" name="pestiside_amount" class="form-control" id="code_name"
                                                value=" {{ !empty($data) ? $data->pestiside_amount : ''}}" placeholder="" required>
                                        </div>
            
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.pestiside_price')}}</label>
                                            <input type="number" name="pestiside_price" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->pestiside_price : ''}}" placeholder=""
                                                required>

                                        </div>
                                     
                                        


                                    </div>
                                    <div class="form-row">
                  
            
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.no_hector')}} </label>
                                            <input type="number" name="no_hector" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->no_hector : ''}}" placeholder=""
                                                required>

                                        </div>
                                     
                                        


                                    </div>
                                 

                                    <div class="form-group row">
                                        <div class="col-lg-offset-2 col-lg-12">
                                        @if($type =='edit-pestiside')
                                            <button class="btn btn-sm btn-primary float-right m-t-n-xs"
                                                data-toggle="modal" data-target="#myModal" type="submit">Update</button>
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
                    $('.item_price' + sub_category_id).val(data[0]["price"]);
                    $(".item_unit" + sub_category_id).val(data[0]["unit"]);
                    $(".item_saved" + sub_category_id).val(data[0]["id"]);
                }

            });

        });


    });
    </script>



    <script type="text/javascript">
    <!--
    $(document).ready(function() {


        var count = 0;


        function autoCalcSetup() {
            $('table#cart').jAutoCalc('destroy');
            $('table#cart tr.line_items').jAutoCalc({
                keyEventsFire: true,
                decimalPlaces: 2,
                emptyAsZero: true
            });
            $('table#cart').jAutoCalc({
                decimalPlaces: 2
            });
        }
        autoCalcSetup();

        $('.add').on("click", function(e) {

            count++;
            var html = '';
            html += '<tr class="line_items">';
            html +=
                '<td><div class="col"><div class="input-group"><select name="item_name[]" class="form-control item_name" required  data-sub_category_id="' +
                count +
                '"><option value="">Choose Cost Type</option>@if(isset($name))@foreach($name as $n) <option value="{{ $n->id}}">{{$n->cost_name}}</option>@endforeach @endif</select></div><div class="input-group-append"><button class="btn btn-primary" type="button" data-toggle="modal" onclick="model()" value="" data-target="#appFormModal"><i class="fa fa-plus-circle"></i></button></div></td>';
            html +=
                '<td><input type="text" name="quantity[]" class="form-control item_quantity" data-category_id="' +
                count + '"placeholder ="quantity" id ="quantity" required /></td>';
            html += '<td><input type="text" name="price[]" class="form-control item_price' + count +
                '" placeholder ="price" required  value=""/></td>';

            html += '<td><select name="tax_rate[]" class="form-control item_tax' + count +
                '" required ><option value="0">Select Tax Rate</option><option value="0">No tax</option><option value="0.18">18%</option></select></td>';
            html += '<input type="hidden" name="total_tax[]" class="form-control item_total_tax' +
                count +
                '" placeholder ="total" required readonly jAutoCalc="{quantity} * {price} * {tax_rate}"   />';
            html += '<input type="hidden" name="saved_items_id[]" class="form-control item_saved' +
                count +
                '"  required   />';
            html += '<td><input type="text" name="total_cost[]" class="form-control item_total' +
                count +
                '" placeholder ="total" required readonly jAutoCalc="{quantity} * {price}" /></td>';
            html +=
                '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="fas fa-trash"></i></button></td>';

            $('tbody').append(html);
            autoCalcSetup();
        });

        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
            autoCalcSetup();
        });


        $(document).on('click', '.rem', function() {
            var btn_value = $(this).attr("value");
            $(this).closest('tr').remove();
            $('tfoot').append(
                '<input type="hidden" name="removed_id[]"  class="form-control name_list" value="' +
                btn_value + '"/>');
            autoCalcSetup();
        });

    });
    //
    -->



    </script>
</div>