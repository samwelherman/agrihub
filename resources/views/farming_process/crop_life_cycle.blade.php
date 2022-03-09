@extends('layouts.master')

@section('content')

<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('farming.crop_cycle')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-2">
                                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link @if($type == 'view-preparation' || $type == 'edit-preparation') active  @endif" id="#tab1" data-toggle="tab"
                                            href="#tab1" role="tab" aria-controls="home"
                                            aria-selected="true">{{__('farming.land')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($type == 'view-sowing') active  @endif" onclick="myFunction()" id="#tab2" data-toggle="tab"
                                            href="#tab2" role="tab" aria-controls="profile"
                                            aria-selected="false">{{__('farming.sowing')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($type == 'view-sowing') active  @endif" onclick="myFunction()" id="#tab2" data-toggle="tab"
                                            href="#tab2" role="tab" aria-controls="profile"
                                            aria-selected="false">Fertilizer</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link @if($type == 'view-sowing') active  @endif" onclick="myFunction()" id="#tab2" data-toggle="tab"
                                            href="#tab2" role="tab" aria-controls="profile"
                                            aria-selected="false">Irrigation</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link @if($type == 'view-sowing') active  @endif" onclick="myFunction()" id="#tab2" data-toggle="tab"
                                            href="#tab2" role="tab" aria-controls="profile"
                                            aria-selected="false">Wedding</a>
                                    </li>


                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-10">
                                <div class="tab-content no-padding" id="myTab2Content">
                                 @include('farming_process.life_cycle_tabs.land_preparation')
                                 @include('farming_process.life_cycle_tabs.sowing')
                                    

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
    function myFunction() {
        alert('hellow')
  var element = document.getElementById("#tab2");
  element.classList.add("active");
}
</script>
@endsection