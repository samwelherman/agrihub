<div class="tab-pane fade @if($type =='preparation' || $type =='edit-preparation') active show  @endif" id="tab1"
    role="tabpanel" aria-labelledby="tab1">
    <div class="card">
        <div class="card-header">
            <h4>{{__('farming.land')}}</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if($type =='preparation')active show @endif" id="home-tab2"
                        data-toggle="tab" href="#home2" role="tab" aria-controls="home"
                        aria-selected="true">{{__('farming.preparation_list')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($type =='edit-preparation') active show @endif" id="profile-tab2"
                        data-toggle="tab" href="#profile2" role="tab" aria-controls="profile"
                        aria-selected="false">{{__('farming.new_preparation')}}</a>
                </li>

            </ul>
            <div class="tab-content tab-bordered" id="myTab3Content">
                <div class="tab-pane fade @if($type =='preparation') active show @endif" id="home2" role="tabpanel"
                    aria-labelledby="home-tab2">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr role="row">


                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.preparation_type')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.soil_salt')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.acid_level')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.moisture_level')}}</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                        colspan="1" aria-label="Engine version: activate to sort column ascending"
                                        style="width: 141.219px;">{{__('farming.preparation_cost')}}</th>
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
                                            href="{{ route('editLifeCycle',['id'=> $row->id,'type'=>'preparation','seasson_id'=>$seasson_id])}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-outline-danger text-uppercase px-2 rounded demo4" onclick="return confirm('are you sure')"
                                            href="{{ route('deleteLifeCycle',['id'=> $row->id,'type'=>'preparation','seasson_id'=>$seasson_id])}}">
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
                <div class="tab-pane fade @if($type =='edit-preparation') active show @endif" id="profile2"
                    role="tabpanel" aria-labelledby="profile-tab2">

                    <div class="card">
                        <div class="card-header">
                            @if($type =='edit-preparation')
                            <h5>{{__('farming.edit_preparation')}}</h5>
                            @else
                            <h5>{{__('farming.add_preparation')}}</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    @if($type =='edit-preparation')
                                    {{ Form::model($id, array('route' => array('cropslifecycle.update', $id), 'method' => 'PUT')) }}
                                    @else
                                    {{ Form::open(['route' => 'cropslifecycle.store']) }}
                                    @method('POST')
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="hidden" name="type" class="form-control" id="type"
                                                value="preparation" placeholder="">
                                            <input type="hidden" name="seasson_id" class="form-control" id="type"
                                                value="{{$seasson_id}}" placeholder="">
                                            <label for="inputEmail4">{{__('farming.preparation_type')}}</label>
                                            <select class="form-control" name="preparation_type" required>
                                                <option value="Clearing and weeding the field">Clearing and weeding the field </option>
                                                <option value="Pre-irrigation">Pre-irrigation </option>
                                                <option value="First ploghing or filling">First ploghing or filling </option>
                                                <option value="Harrowing">Harrowing</option>
                                                <option value="Flooding ">Flooding </option>
                                                <option value="Levelling">Levelling </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.soil_salt')}}</label>
                                            <select class="form-control" name="soil_salt" required>
                                                <option value="Lime">Lime </option>
                                                <option value="salt">salt</option>
                                                <option value="Neutral">Neutral</option>

                                            </select>

                                        </div>


                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label for="inputEmail4">{{__('farming.acid_level')}}</label>
                                            <input type="text" name="acid_level" class="form-control" id="code_name"
                                                value=" {{ !empty($data) ? $data->acid_level : ''}}" placeholder=""
                                                required>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.moisture_level')}}</label>
                                            <input type="number" name="moisture_level" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->moisture_level : ''}}" placeholder=""
                                                required>

                                        </div>
                                        <hr>
                                        <button type="button" name="add1" class="btn btn-success btn-xs add1"><i
                                                class="fas fa-plus">{{__('farming.add')}}
                                                {{__('farming.preparation_cost')}}</i></button><br>
                                        <br>
                                        <table class="table table-bordered" id="cart">
                                            <thead>
                                                <tr>
                                                    <th>{{__('farming.cost_type')}}</th>
                                                    <th>{{__('farming.quantity')}}</th>
                                                    <th>{{__('farming.cost')}}</th>
                                                    <th>Recomendation</th>

                                                    <th>{{__('farming.tax')}}</th>
                                                    <th>{{__('farming.total')}}</th>
                                                    <th>{{__('farming.action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                            <tfoot>

                                                @if(!@empty($costs))
                                                @foreach ($costs as $i)
                                                <tr class="line_items">
                                                    <td><select name="item_name[]" class="form-control item_name"
                                                            required data-sub_category_id={{$i->id}}>
                                                            <option value="">Select Item</option>@foreach($name
                                                            as $n) <option value="{{ $n->id}}" @if(isset($i))@if($n->id
                                                                == $i->item_name)
                                                                selected @endif @endif >{{$n->name}}</option>
                                                            @endforeach
                                                        </select></td>
                                                    <td><input type="text" name="quantity[]"
                                                            class="form-control item_quantity{{$i->order_no}}"
                                                            placeholder="quantity" id="quantity"
                                                            value="{{ isset($i) ? $i->quantity : ''}}" required /></td>
                                                    <td><input type="text" name="price[]"
                                                            class="form-control item_price{{$i->order_no}}"
                                                            placeholder="price" required
                                                            value="{{ isset($i) ? $i->price : ''}}" /></td>

                                                    <td><select name="tax_rate[]"
                                                            class="form-control item_tax'+count{{$i->order_no}}"
                                                            required>
                                                            <option value="0">Select Tax Rate</option>
                                                            <option value="0" @if(isset($i))@if('0'==$i->
                                                                tax_rate) selected @endif @endif>No tax</option>
                                                            <option value="0.18" @if(isset($i))@if('0.18'==$i->
                                                                tax_rate) selected @endif @endif>18%</option>
                                                        </select></td>
                                                    <input type="hidden" name="total_tax[]"
                                                        class="form-control item_total_tax{{$i->order_no}}'"
                                                        placeholder="total" required
                                                        value="{{ isset($i) ? $i->total_tax : ''}}" readonly
                                                        jAutoCalc="{quantity} * {price} * {tax_rate}" />
                                                    <input type="hidden" name="saved_items_id[]"
                                                        class="form-control item_saved{{$i->order_no}}"
                                                        value="{{ isset($i) ? $i->saved_items_id : ''}}" required />
                                                    <td><input type="text" name="total_cost[]"
                                                            class="form-control item_total{{$i->order_no}}"
                                                            placeholder="total" required
                                                            value="{{ isset($i) ? $i->total_cost : ''}}" readonly
                                                            jAutoCalc="{quantity} * {price}" /></td>
                                                    <input type="hidden" name="items_id[]"
                                                        class="form-control name_list"
                                                        value="{{ isset($i) ? $i->items_id : ''}}" />
                                                    <td><button type="button" name="remove"
                                                            class="btn btn-danger btn-xs rem"
                                                            value="{{ isset($i) ? $i->items_id : ''}}"><i
                                                                class="fas fa-trash"></i></button></td>
                                                </tr>

                                                @endforeach
                                                @endif


                                                <tr class="line_items">
                                                    <td colspan="4"></td>
                                                    <td><span class="bold">Sub Total </span>: </td>
                                                    <td><input type="text" name="subtotal[]"
                                                            class="form-control item_total" placeholder="subtotal"
                                                            required jAutoCalc="SUM({total_cost})" readonly></td>
                                                </tr>
                                                <tr class="line_items">
                                                    <td colspan="4"></td>
                                                    <td><span class="bold">Tax </span>: </td>
                                                    <td><input type="text" name="tax[]" class="form-control item_total"
                                                            placeholder="tax" required jAutoCalc="SUM({total_tax})"
                                                            readonly>
                                                    </td>
                                                </tr>
                                                @if(!@empty($data->discount > 0))
                                                <tr class="line_items">
                                                    <td colspan="4"></td>
                                                    <td><span class="bold">Discount</span>: </td>
                                                    <td><input type="text" name="discount[]"
                                                            class="form-control item_discount" placeholder="total"
                                                            required value="{{ isset($data) ? $data->discount : ''}}"
                                                            readonly></td>
                                                </tr>
                                                @endif

                                                <tr class="line_items">
                                                    <td colspan="4"></td>
                                                    @if(!@empty($data->discount > 0))
                                                    <td><span class="bold">Total</span>: </td>
                                                    <td><input type="text" name="amount[]"
                                                            class="form-control item_total" placeholder="total" required
                                                            jAutoCalc="{subtotal} + {tax} - {discount}" readonly></td>
                                                    @else
                                                    <td><span class="bold">Total</span>: </td>
                                                    <td><input type="text" name="amount[]"
                                                            class="form-control item_total" placeholder="total" required
                                                            jAutoCalc="{subtotal} + {tax}" readonly>
                                                    </td>
                                                    @endif
                                                </tr>
                                            </tfoot>
                                        </table>


                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-offset-2 col-lg-12">
                                            @if($type =='edit-preparation')
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

        $('.add1').on("click", function(e) {

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

            html += '<td><input type="text" name="recommendation[]" class="form-control item_price' + count +
                '" placeholder ="recommendation" required  value=""/></td>';

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