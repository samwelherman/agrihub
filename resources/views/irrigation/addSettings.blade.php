<div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">{{__('farming.irrigation_setting')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="ibox d-none ibox-loading">
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>
                        <div style="height: 100px !important;"></div>
                    </div>
                </div>
        <form id="addSettingsForm" method="post" action="javascript:void(0)">
        @csrf
        <div class="modal-body">
        <div class="alert alert-danger d-none errors col-12" role="alert"> </div>

            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.irrigation_type')}}</label>
                        <select name="irrigation_type" id="irrigation_type" class="form-control">
                            @if(!empty($irrigation_system))
                            @foreach($irrigation_system as $row)
                            <option value="{{$row->id}}">{{$row->name}}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.irrigation_cost')}}</label>
                        <input type="number" name="irrigation_cost" id="irrigation_cost" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.number_of_hk')}}</label>
                        <input type="number" name="number_of_hk" id="number_of_hk" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.power_source')}}</label>
                        <input type="number" name="power_source" id="power_source" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.pump_cost')}}</label>
                        <input type="text" name="pump_cost" id="pump_cost" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.total_cost')}}</label>
                        <input type="number" name="total_cost" id="total_cost" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.pump_rate')}}</label>
                        <input type="text" name="pump_rate" id="pump_rate" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.hector_per_day')}}</label>
                        <input type="number" name="hector_per_day" id="hector_per_day" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.pump_no')}}</label>
                        <input type="text" name="pump_no" id="pump_no" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <label>{{__('farming.hector_per_day')}}</label>
                        <input type="number" name="total_pump_cost" id="total_pump_cost" class="form-control">
                    </div>
                </div>
            </div>
           
        </div>
        <div class="modal-footer bg-whitesmoke br">
            
            <input type="submit" value="Save" class="btn btn-primary" onclick="saveIrrigation(this)">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
</div>