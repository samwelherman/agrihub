<div class="tab-pane fade @if($type =='view-sowing' || $type =='edit-sowing') active show  @endif" id="tab2"
    role="tabpanel" aria-labelledby="tab2">
    <div class="card">
        <div class="card-header">
            <h4>{{__('farming.sowing')}}</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if($type =='view-sowing')active show @endif" id="home-tab3" data-toggle="tab"
                        href="#home3" role="tab" aria-controls="home" onclick="{ $type = 'view-sowing'}"
                        aria-selected="true">{{__('farming.sowing')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($type =='edit-sowing') active show @endif" id="profile-tab3"
                        data-toggle="tab" href="#profile3" role="tab" aria-controls="profile"
                        onclick="{ $type = 'edit-sowing'}" aria-selected="false">{{__('farming.new_sowing')}}</a>
                </li>

            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade @if($type =='view-sowing') active show @endif" id="home3" role="tabpanel"
                    aria-labelledby="home-tab3">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr role="row">


                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.crops_type')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.seed_type')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.qheck')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.nh')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.qn')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                        style="width: 98.1094px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!@empty($preparationDetails))
                                @foreach ($preparationDetails as $row)
                                <tr class="gradeA even" role="row">
                                    <td>{{$row->preparation_type}}</td>
                                    <td>{{$row->soil_salt}}</td>
                                    <td>{{$row->acid_level}}</td>

                                    <td>{{$row->moisture_level}}</td>
                                    <td>{{$row->preparation_cost}}</td>


                                    <td>

                                        <a class="btn btn-xs btn-outline-info text-uppercase px-2 rounded"
                                            href="{{ route('editLifeCycle',['id'=> $row->id,'type'=>'preparation'])}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-outline-danger text-uppercase px-2 rounded demo4"
                                            href="{{ route("seasson.destroy", $row->id)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>


                                    </td>
                                </tr>
                                @endforeach

                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade @if($type =='edit-sowing') active show @endif" id="profile3" role="tabpanel"
                    aria-labelledby="profile-tab3">

                    <div class="card">
                        <div class="card-header">
                            @if(!empty($id))
                            <h5>{{__('farming.sowing')}}</h5>
                            @else
                            <h5>{{__('farming.new_sowing')}}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    @if(isset($id))
                                    {{ Form::model($id, array('route' => array('cropslifecycle.update', $id), 'method' => 'PUT')) }}
                                    @else
                                    {{ Form::open(['route' => 'cropslifecycle.store']) }}
                                    @method('POST')
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="hidden" name="type" class="form-control" id="type"
                                                value="sowing" placeholder="">
                                            <input type="hidden" name="id" class="form-control" id="type"
                                                value="{{$id}}" placeholder="">
                                            <label for="inputEmail4">{{__('farming.crops_type')}}</label>
                                            <select class="form-control" name="crops_type" required>
                                                <option value="type A">Type A </option>
                                                <option value="type B">Type B </option>
                                                <option value="type C">Type C </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.seed_type')}}</label>
                                            <select class="form-control" name="seed_type" required>
                                                <option value="Lime">Lime </option>
                                                <option value="none">None</option>

                                            </select>

                                        </div>


                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label for="inputEmail4">{{__('farming.qheck')}}</label>
                                            <input type="number" name="qheck" class="form-control" id="code_name"
                                                value=" {{ !empty($data) ? $data->qheck : ''}}" placeholder="" required>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.cost')}}</label>
                                            <input type="number" name="cost" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->moisture_level : ''}}" placeholder=""
                                                required>

                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.nh')}}</label>
                                            <input type="number" name="nh" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->nh : ''}}" placeholder=""
                                                required>

                                        </div>
                                     
                                        


                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-offset-2 col-lg-12">
                                            @if(!@empty($id))
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