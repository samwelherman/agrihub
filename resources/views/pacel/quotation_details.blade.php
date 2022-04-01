@extends('layouts.master')


@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">

            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="padding-20">
                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                                    aria-selected="true">Parcel Details</a>
                            </li>
                            @if($purchases->good_receive == 1 )
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab2"
                                    href="{{ route('pacel.pay',$purchases->id)}}" role="tab"
                                    aria-selected="false">Make
                                    Payments</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab2"
                                    href="{{ route('pacel_pdfview',['download'=>'pdf','id'=>$purchases->id]) }}" role="tab"
                                    aria-selected="false">
                                    Download PDF</a>
                                    
                            </li>

                            @if($purchases->good_receive == 0 && $purchases->status != 7)
                            <li class="nav-item">                         
                                <a class="nav-link"
                                    title="Edit" onclick="return confirm('Are you sure?')"
                                    href="{{ route('pacel_quotation.edit', $purchases->id)}}">Edit </a>
                                        
                                    </li>
                                    @endif
                        </ul>
                        <?php
$settings= App\Models\System::first();


?>
                        <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="about" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <div class="row">
                                    <div class="col-md-3 col-6 b-r">
                                        <img src="{{url('public/assets/img/logo')}}/{{$settings->picture}}" width="300px;">
                                        <br>

                                    </div>
                                    <div class="col-md-6 col-6 b-r">

                                    </div>

                                    <div class="col-md-3 col-6">
                                        <h4 class="name">{{$settings->name}}</h4>
                                        <div>{{ !empty($settings->address) ? $settings->address : 'address' }}</div>
                                        <div>{{!empty($settings->phone) ? $settings->phone : 'Phone'}}</div>
                                        <div><a
                                                href="mailto:{{$settings->email}}">{{!empty($settings->email) ? $settings->email : 'Email'}}</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-3 col-6 b-r">
                                        <div class="to">INVOICE TO:</div>
                                        @php    
                                        $supp=App\Models\Supplier::where('id', $purchases->supplier_id)->first();   
                                      @endphp
                                        <h5 class="name">
                                            {{!empty($supp->name) ? $supp->name : 'no name' }}
                                        </h5>
                                        <div class="address">
                                            {{!empty($supp->address) ? $supp->address : 'no address' }}
                                        </div>
                                        <div class="email"><a
                                                href="mailto:{{!empty($supp->email) ? $supp->email : 'no email' }}">{{!empty($supp->email) ? $supp->email : 'no email' }}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6 b-r">

                                    </div>

                                    <div class="col-md-3 col-6">
                                        REF NO : {{$purchases->pacel_number}}
                                        <div class="date">Date: {{$purchases->date}}</div>
                                        <div class="date">Status: 
                                            @if($purchases->good_receive == 0 && $purchases->status == 0)
                                            <div class="badge badge-danger badge-shadow">Not Invoiced</div>
                                            @elseif($purchases->status == 0 )
                                            <div class="badge badge-primary badge-shadow">Invoiced</div>
                                            @elseif($purchases->status == 1)
                                            <div class="badge badge-info badge-shadow">Partially Paid</div>
                                            @elseif($purchases->status == 2)
                                            <div class="badge badge-success badge-shadow"> Paid Invoice</span>
                                            @elseif($purchases->status == 7)
                                            <div class="badge badge-danger badge-shadow">Cancelled</span>

                                            @endif
                                        
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <?php
                               
                                 $sub_total = 0;
                                 $gland_total = 0;
                                 $tax=0;
                                 $i =1;
       
                                 ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">DESCRIPTION</th>
                                            <th scope="col">UNIT PRICE</th>
                                            <th scope="col">QUANTITY</th>
                                            <th scope="col">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($purchase_items))
                                        @foreach($purchase_items as $row)
                                        <?php
                                         $sub_total +=$row->total_cost;
                                         $gland_total +=$row->total_cost +$row->total_tax;
                                         $tax += $row->total_tax; 
                                         ?>
                                        <tr>
                                            <td class="">{{$i++}}</td>
                                            <?php
                                          $item_name = App\Models\Pacel\PacelList::find($row->item_name);
                                        ?>
                                            <td class="">
                                                <p style="padding-right:80px;">{{$item_name->name}}</p>
                                            </td>
                                            <td class="">{{ $row->price }} {{$purchases->currency_code}}</td>
                                            <td class="">{{ $row->quantity }} </td>
                                            <td class="">{{ $row->total_cost }} {{$purchases->currency_code}}</td>
                                            
                                        </tr>
                                        @endforeach
                                        @endif

                                       
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">
                                                <b>SUBTOTAL</b>
                                                
                                                
                                            </td>
                                            
                                            <td>
                                                <b>{{number_format($sub_total,2)}}  {{$purchases->currency_code}}</b>
                                               
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">
                                                <b>TAX 18%</b>
                                                
                                            </td>
                                            <td>
                                                <b>{{number_format($tax,2)}}  {{$purchases->currency_code}}</b>
                                                
                                            </td>
                                        </tr>
                                        @if(!@empty($purchases->discount > 0))
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">
                                                <b>LESS: DISCOUNT</b></td>
                                            <td><b>{{$purchases->discount}}  {{$purchases->currency_code}}</b></td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">
                                                <b>GRAND TOTAL</b>
                                            </td>
                                            <td>
                                                <b>{{number_format($gland_total - $purchases->discount,2)}}
                                                {{$purchases->currency_code}}</b>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <hr>
                                @if($purchases->currency_code != 'TZS')
                                <b>NOTE : 1 {{$purchases->currency_code}} = {{$purchases->exchange_rate}} TZS </b>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            @if(!empty($payments[0]))
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="padding-20">
                        <h5 style="text-align:center">PAYMENT SUMMARY</h5>
                      <div class="tab-content tab-bordered" id="myTab3Content">
                            <div class="tab-pane fade show active" id="about" role="tabpanel"
                                aria-labelledby="home-tab2">
                                <div class="row">     
                            
                                <hr>
                                <?php
                               
                                
                                 $i =1;
       
                                 ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">TRANSACTION ID</th>
                                            <th scope="col">AMOUNT</th>
                                            <th scope="col">DATE</th>
                                            <th scope="col">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @foreach($payments as $row)
                                       
                                        <tr>
                                            <td class="">{{$i++}}</td>
                                           
                                            <td class="">
                                                {{$row->trans_id}}
                                            </td>
                                            <td class="">{{ $row->amount }} {{$purchases->currency_code}}</td>
                                            <td class="">{{ $row->date }}</td>
                                            <td class=""><a class="btn btn-xs btn-outline-info text-uppercase px-2 rounded"
                                            title="Edit" onclick="return confirm('Are you sure?')"
                                            href="{{ route('pacel_payment.edit', $row->id)}}"><i
                                                class="fa fa-edit"></i></a></td>
                                        </tr>
                                        @endforeach
                                       


                                    </tbody>
                                   
                                </table>
                                <hr>
                                @if($purchases->currency_code != 'TZS')
                                <b>NOTE : 1 {{$purchases->currency_code}} = {{$purchases->exchange_rate}} TZS </b>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            @endif


        </div>
    </div>
</section>


@endsection

@section('scripts')

@endsection