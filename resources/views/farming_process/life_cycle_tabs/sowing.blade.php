<div class="tab-pane fade @if($type =='sowing' || $type =='edit-sowing') active show  @endif" id="sowing"
    role="tabpanel" aria-labelledby="sowing">
    <div class="card">
        <div class="card-header">
            <h4>{{__('farming.sowing')}}</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link @if($type =='sowing')active show @endif" id="home-tab3" data-toggle="tab"
                        href="#home3" role="tab" aria-controls="home" onclick="{ $type = 'sowing'}"
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
                <div class="tab-pane fade @if($type =='sowing') active show @endif" id="home3" role="tabpanel"
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
                                @if(!@empty($sowing))
                                @foreach ($sowing as $row)
                                <tr class="gradeA even" role="row">
                                    <td>{{$row->crops_type->crop_name}}</td>
                                    <td>{{$row->seeds_type->name}}</td>
                                    <td>{{$row->qheck}}</td>

                                    <td>{{$row->nh}}</td>
                                    <td>{{$row->qn}}</td>


                                    <td>

                                        <a class="btn btn-xs btn-outline-info text-uppercase px-2 rounded"
                                            href="{{ route('editLifeCycle',['id'=> $row->id,'type'=>'sowing','seasson_id'=>$seasson_id])}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="btn btn-xs btn-outline-danger text-uppercase px-2 rounded demo4" onclick="return confirm('are you sure')"
                                            href="{{ route('deleteLifeCycle',['id'=> $row->id,'type'=>'sowing','seasson_id'=>$seasson_id])}}">
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
                                @if($type =='edit-sowing')
                                    {{ Form::model($id, array('route' => array('cropslifecycle.update', $id), 'method' => 'PUT')) }}
                                    @else
                                    {{ Form::open(['route' => 'cropslifecycle.store']) }}
                                    @method('POST')
                                    @endif

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="hidden" name="type" class="form-control" id="type"
                                                value="sowing" placeholder="">
                                                <input type="hidden" name="seasson_id" class="form-control" id="type"
                                                value="{{$seasson_id}}" placeholder="">
                                                <?php $crops_type = App\Models\Crops_type::all();  ?>
                                            <label for="inputEmail4">{{__('farming.crops_type')}}</label>
                                            <select class="form-control" name="crop_type" required>
                                                @if(!empty($crops_type))
                                                @foreach($crops_type as $row)
                                                <option value="{{$row->id}}" {{(!empty($data)&&($data->crop_type==$row->id))? 'selected':''}}>{{$row->crop_name}} </option>
                                            @endforeach
                                            @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.seed_type')}}</label>
                                            <?php $seeds_type = App\Models\farming\Seeds_type::all();  ?>
                                            <select class="form-control" name="seed_type" required>
                                            @if(!empty($seeds_type))
                                                @foreach($seeds_type as $row)
                                                <option value="{{$row->id}}" {{(!empty($data)&&($data->seed_type==$row->id))? 'selected':''}}>{{$row->name}} </option>
                                            @endforeach
                                            @endif

                                            </select>

                                        </div>


                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">

                                            <label for="inputEmail4">{{__('farming.qheck')}}</label>
                                            <input type="number" name="qheck" class="form-control" id="qheck"
                                                value="{{ !empty($data) ? $data->qheck : ''}}" placeholder="" required>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.cost')}}</label>
                                            <input type="number" name="cost" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->cost : ''}}" placeholder=""
                                                required>

                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.nh')}}</label>
                                            <input type="number" name="nh" class="form-control" id="costing"
                                                value="{{ !empty($data) ? $data->nh : ''}}" placeholder=""
                                                required>

                                        </div>

                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="date">{{__('farming.harvest_date')}}</label>
                                            <input type="date" name="harvest_date" class="form-control" id="harvest_date"
                                                value="{{ !empty($data) ? $data->nh : ''}}" placeholder=""
                                                required>

                                        </div>
                                     
                                        


                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-offset-2 col-lg-12">
                                        @if($type =='edit-sowing')
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

     




    });
    //
    -->



    </script>
</div>