<div class="tab-pane fade @if($type =='post_harvest' || $type =='edit-post_harvest') active show  @endif"
    id="post_harvest" role="tabpanel" aria-labelledby="post_harvest">
    <div class="card">
        <div class="card-header">
            <h4>{{__('farming.post_harvest')}}</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if($type =='post_harvest')active show @endif" id="home-tab4" data-toggle="tab"
                        href="#home8" role="tab4" aria-controls="home8" onclick="{ $type = 'post_harvest'}"
                        aria-selected="true">{{__('farming.post_harvest')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($type =='edit-post_harvest') active show @endif" id="profile-tab4"
                        data-toggle="tab" href="#profile8" role="tab" aria-controls="profile"
                        onclick="{ $type = 'edit-post_harvest'}"
                        aria-selected="false">{{__('farming.new_post_harvest')}}</a>
                </li>

            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade @if($type =='post_harvest') active show @endif" id="home8" role="tabpanel"
                    aria-labelledby="home-tab4">
                    <div class="table-responsive">
                        <table class="table table-striped col-lg-12 col-sm-12" id="table-1">
                            <thead>
                                <tr role="row">


                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.maturity_index')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.crop_type')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.grade')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.distance')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.parking_type')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.moisture_level')}}</th>

                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="CSS grade: activate to sort column ascending"
                                        style="width: 98.1094px;">{{__('farming.action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($post_harvest))
                                @foreach ($post_harvest as $row)
                                <tr class="gradeA even" role="row">
                                    <td>{{$row->maturity_index}}</td>
                                    <td>{{$row->crops_type->crop_name}}</td>
                                    <td>{{$row->grade}}</td>
                                    <td>{{$row->distance}}</td>

                                    <td>{{$row->parking_types->parking_name}}</td>
                                    <td>{{$row->moisture_level}}</td>



                                    <td>

                                        <a class="btn btn-xs btn-outline-info text-uppercase px-2 rounded"
                                            href="{{ route('editLifeCycle',['id'=> $row->id,'type'=>'post_harvest','seasson_id'=>$seasson_id])}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-outline-danger text-uppercase px-2 rounded demo4"
                                            href="{{ route('seasson.destroy', $row->id)}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-success dropdown-toggle"
                                                data-toggle="dropdown">Change<span class="caret"></span></button>
                                            <ul class="dropdown-menu animated zoomIn">
                                                <li class="nav-item"><a class="nav-link" title="quotation"
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
                <div class="tab-pane fade @if($type =='edit-post_harvest') active show @endif" id="profile8"
                    role="tabpanel" aria-labelledby="profile-tab4">

                    <div class="card">
                        <div class="card-header">
                            @if(!empty($id))
                            <h5>{{__('farming.post_harvest')}}</h5>
                            @else
                            <h5>{{__('farming.new_post_harvest')}}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    @if($type =='edit-post_harvest')
                                    {{ Form::model($id, array('route' => array('cropslifecycle.update', $id), 'method' => 'PUT')) }}
                                    @else
                                    {{ Form::open(['route' => 'cropslifecycle.store']) }}
                                    @method('POST')
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="hidden" name="type" class="form-control" id="type"
                                                value="post_harvest" placeholder="">
                                            <input type="hidden" name="seasson_id" class="form-control" id="type"
                                                value="{{$seasson_id}}" placeholder="">
                                            <?php $crops_type = App\Models\Crops_type::all();  ?>
                                            <label for="inputEmail4">{{__('farming.crop_type')}}</label>
                                            <select class="form-control" name="crop_type" required>
                                                @if(!empty($crops_type))
                                                @foreach($crops_type as $row)
                                                <option value="{{$row->id}}"
                                                    {{(!empty($data)&&($data->crop_type==$row->id))? 'selected':''}}>
                                                    {{$row->crop_name}} </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.grade')}} </label>
                                            <input type="text" name="grade" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->grade : ''}}" placeholder=""
                                                required>

                                        </div>



                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label for="inputEmail4">{{__('farming.maturity_index')}}</label>
                                            <input type="text" name="maturity_index" class="form-control" id="code_name"
                                                value=" {{ !empty($data) ? $data->maturity_index : ''}}" placeholder=""
                                                required>
                                        </div>

                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.distance')}}</label>
                                            <input type="number" name="distance" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->distance : ''}}" placeholder=""
                                                required>

                                        </div>




                                    </div>
                                    <div class="form-row">


                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.moisture_level')}} </label>
                                            <input type="number" name="moisture_level" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->moisture_level : ''}}" placeholder=""
                                                required>

                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.parking_type')}} </label>
                                            <?php $parking_type = App\Models\farming\ParkingType::all();  ?>
                                            <select class="form-control" name="parking_type" required>
                                                @if(!empty($parking_type))
                                                @foreach($parking_type as $row)
                                                <option value="{{$row->id}}"
                                                    {{(!empty($data)&&($data->parking_type==$row->id))? 'selected':''}}>
                                                    {{$row->parking_name}} </option>
                                                @endforeach
                                                @endif
                                            </select>

                                        </div>



                                    </div>


                                    <div class="form-group row">
                                        <div class="col-lg-offset-2 col-lg-12">
                                            @if($type =='edit-pre_harvest')
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