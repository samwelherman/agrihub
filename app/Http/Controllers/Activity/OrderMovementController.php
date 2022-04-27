<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\orders\Activity;
use App\Models\orders\Cost_function;
use App\Models\orders\OrderMovement;
use App\Models\orders\Order;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\TruckInsurance;
use App\Models\Sticker;
use App\Models\Fuel\Fuel;
use App\Models\Mileage;
use App\Models\Route;
use App\Models\Pacel\Pacel;
use App\Models\JournalEntry;
use App\Models\AccountCodes;
use App\Models\Client;
use App\Models\Region;
use App\Models\User;
use App\Models\CargoLoading;
use App\Models\CargoCollection;

class OrderMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 public function findTruck(Request $request)
    {

       $collect=CargoCollection::find($request->collection);
     $data['id']=$request->collection;
               $data['truck']= Truck::where('truck_status','Available')->where('location',$collect->start_location)->where('truck_type','!=','Trailer')->where('type',$request->id)->get(); 
                 $data['driver']=Driver::where('available','1')->where('type',$request->id)->get();   
                return response()->json(['html' => view('order_movement.addtruck', $data)->render()]);     

       

}

    public function show($id,Request $request)
    {
        //
        switch ($request->type) {
            case 'collection':
           $collect=CargoCollection::find($id);
               $truck = Truck::where('truck_status','Available')->where('location',$collect->start_location)->where('truck_type','!=','Trailer')->get(); 
                 $driver =Driver::where('available','1')->get(); 
                    return view('order_movement.addcollection',compact('id','truck','driver'));
                    break;
            case 'loading':
                        return view('order_movement.addloading',compact('id'));
                        break;
            case 'offloading':
                            return view('order_movement.addoffloading',compact('id'));
                            break;
            case 'delivering':
                                return view('order_movement.adddelivering',compact('id'));
                                break;
              case 'fuel':
                        return view('order_movement.addfuel',compact('id'));
                        break;
             
             default:
             return abort(404);
             
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function collection(){
        $user_id=auth()->user()->id;
       
          $quotation = CargoCollection::where('status','2')->get();
        $costs = Cost_function::all()->where('user_id',$user_id);

        return view('order_movement.collection',compact('quotation','costs'));

    }

    public function loading(){
        $user_id=auth()->user()->id;
        $quotation = CargoLoading::where('status','3')->get();
        $costs = Cost_function::all()->where('user_id',$user_id);

        return view('order_movement.loading',compact('quotation','costs'));

    }

    public function offloading(){
        $user_id=auth()->user()->id;
        $quotation = CargoLoading::where('status','4')->get();
        $costs = Cost_function::all()->where('user_id',$user_id);
       
        return view('order_movement.offloading',compact('quotation','costs'));

    }

    public function delivering(){
        $user_id=auth()->user()->id;
        $quotation = CargoLoading::where('status','5')->orwhere('status','6')->get();
        $costs = Cost_function::all()->where('user_id',$user_id);

        return view('order_movement.delivering',compact('quotation','costs'));

    }
   public function return(){
        $truck = Truck::all(); 
         $driver = Driver::all(); 
        $route=Route::all();    
      $region = Region::all();   
       $id=1;
        return view('order_movement.fuel',compact('region','route','driver','truck','id'));

    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        switch ($request->type) {
            case 'collection':

                $movement=CargoCollection::find($id);
                $truck=Truck::where('id',$request->truck_id)->first();
             $driver=Driver::find($request->driver_id);

$loading=CargoLoading::where('status','!=', 6)->where('truck_id', $request->truck_id)->sum('weight');

if($movement->due_weight <= ($truck->capacity - $loading)){
$wght= 0;
$weight=$movement->due_weight;
}
else{
$wght=$movement->due_weight - ($truck->capacity - $loading);
$weight=$truck->capacity - $loading;
}

if($movement->weight - $wght == $truck->capacity - $loading){
$truck->update(['truck_status'=>'Unavailable']);
   }  
$driver->update(['available'=>'0']);

                    $loading_cargo =CargoLoading::create(
                        [ 
                            'added_by'=>auth()->user()->id,
                            'truck_id'=>$request->truck_id,
                            'driver_id'=>$request->driver_id,
                            'type'=>$request->owner_type,
                            'weight'=>$weight,
                           'total_weight'=>$movement->weight,
                            'status'=>'3',
                        'fuel'=>'0',
                           'pacel_id'=>$movement->pacel_id,
                           'pacel_name'=>$movement->pacel_name,
                         'pacel_number'=>$movement->pacel_number,
                         'start_location'=> $movement->start_location,
                         'end_location'=>$movement->end_location,
                        'owner_id'=>$movement->owner_id,
                       'receiver_name'=>$movement->receiver_name,
                        'amount'=>$movement->amount,
                        'route_id'=>$movement->route_id,
                       'collection_date'=>$request->collection_date,
                        ]
                        );                      
      



                 
                if(!empty($loading_cargo)){
                    $activity = Activity::create(
                        [ 
                            'added_by'=>auth()->user()->id,
                            'module_id'=>$movement->pacel_id,
                            'module'=>'Cargo',
                            'activity'=>"Confirm Collection",
                            'notes'=>$request->notes,
                          'loading_id'=>$loading_cargo->id,
                           'date'=>$request->collection_date,
                        ]
                        );                      
       }

              
    if($wght != '0'){
 $data['due_weight']=$wght;

 $user_id=auth()->user()->id;
  $quotation = CargoCollection::where('status','2')->get();
   $costs = Cost_function::all()->where('user_id',$user_id);

$result=$movement->update($data);

  return redirect(route('order.collection'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Collected Successfully']);
}

else{
$data['due_weight']=$wght;
 $data['status']='3';

 $user_id=auth()->user()->id;
  $quotation = CargoLoading::where('status','3')->get();
   $costs = Cost_function::all()->where('user_id',$user_id);

$result=$movement->update($data);

  return redirect(route('order.loading'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Collected Successfully']);
}


                    break;


                   case 'fuel':
                        $movement=CargoLoading::find($id);
                        $result=$movement->update(['fuel'=>1]);
                         
                                                               
       $route = Route::find($movement->route_id); 
   $name=$movement->pacel_name;


       $data['route_id']=$movement->route_id;
    $data['fuel_rate']=$request->fuel;
        $data['fuel_used']=$route->distance/$request->fuel;
        $data['due_fuel']=$route->distance/$request->fuel;
        $data['added_by']=auth()->user()->id;
        $data['driver_id']=$movement->driver_id;
      $data['truck_id']=$movement->truck_id;
    $data['movement_id']=$movement->id;
 $data['status_approve']='0';
        $fuel= Fuel::create($data);


  $items['route_id']=$movement->route_id;
   $items['fuel_rate']=$request->mileage;
        $items['total_mileage']=$route->distance * $request->mileage;
       $items['due_mileage']=$route->distance * $request->mileage;
        $items['added_by']=auth()->user()->id;
        $items['driver_id']=$movement->driver_id;
      $items['truck_id']=$movement->truck_id;
    $items['movement_id']=$movement->id;
 $items['status_approve']='0';
$items['payment_status']='0';
        $mileage= Mileage ::create($items);

 $driver=Driver::find($movement->driver_id);
   $truck=Truck::find($movement->truck_id);
     
 $cr= AccountCodes::where('account_name','Mileage')->first();
    $journal = new JournalEntry();
  $journal->account_id = $cr->id;
  $date = explode('-',$mileage->created_at);
  $journal->date =   $mileage->created_at ;
  $journal->year = $date[0];
  $journal->month = $date[1];
 $journal->transaction_type = 'mileage';
  $journal->name = 'Mileage';
  $journal->debit = $mileage->total_mileage ;
  $journal->income_id= $mileage->id;
   $journal->currency_code =  'TZS';
  $journal->exchange_rate= '1';
     $journal->notes= "Mileage of Shipment " .$name ."  to Driver  ". $driver->driver_name ." with Truck ".$truck->truck_name ;
  $journal->save();


  $codes= AccountCodes::where('account_name','Payables')->first();
  $journal = new JournalEntry();
  $journal->account_id = $codes->id;
  $date = explode('-',$mileage->created_at);
  $journal->date =   $mileage->created_at ;
  $journal->year = $date[0];
  $journal->month = $date[1];
   $journal->transaction_type = 'mileage';
  $journal->name = 'Mileage';
   $journal->income_id= $mileage->id;
  $journal->credit =$mileage->total_mileage ;
  $journal->currency_code =  'TZS';
  $journal->exchange_rate= '1';
     $journal->notes= "Mileage of Shipment " .$name ."  to Driver  ". $driver->driver_name ." with Truck ".$truck->truck_name ;
  $journal->save();


                        $user_id=auth()->user()->id;
                        $quotation = CargoLoading::where('status','3')->get();
                        $costs = Cost_function::all()->where('user_id',$user_id);
                       
                        return redirect(route('order.loading'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Fuel and Mileage Assigned Successfully']);
                            break;




                    case 'loading':
                        $movement= CargoLoading::find($id);
                        $result=$movement->update(['status'=>4]);
                         
                        if(!empty($result)){
                            $activity = Activity::create(
                                [ 
                                    'added_by'=>auth()->user()->id,
                                    'module_id'=>$movement->pacel_id,
                                    'module'=>'Cargo',
                                    'activity'=>"Confirm Loading",
                                    'notes'=>$request->notes,
                                'loading_id'=>$id,
                                   'date'=>$request->collection_date,
                                ]
                                );                      
               }
        
                        $user_id=auth()->user()->id;
                        $quotation = CargoLoading::where('status','4')->get();
                        $costs = Cost_function::all()->where('user_id',$user_id);
                       
                        return redirect(route('order.offloading'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Loaded Successfully']);
                            break;

                            case 'offloading':
                                $movement=CargoLoading::find($id);
                                $result=$movement->update(['status'=>5]);
                                 
                                if(!empty($result)){
                                    $activity = Activity::create(
                                        [ 
                                            'added_by'=>auth()->user()->id,
                                            'module_id'=>$movement->pacel_id,
                                            'module'=>'Cargo',
                                            'activity'=>"Confirm Offloading",
                                            'notes'=>$request->notes,
                                            'loading_id'=>$id,
                                           'date'=>$request->collection_date,
                                        ]
                                        );                      
                       }

 
    

                
                                $user_id=auth()->user()->id;
                                $quotation =  CargoLoading::where('status','5')->get();
                                $costs = Cost_function::all()->where('user_id',$user_id);
                               
                                return redirect(route('order.delivering'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Offloaded Successfully']);
                                    break;

                                    case 'delivering':
                                        $movement= CargoLoading::find($id);
                                        $result=$movement->update(['status'=>6]);

                                         $truck=Truck::find($movement->truck_id);
                                         $driver=Driver::find($movement->driver_id);
                                           if(!empty($result)){
                                     $item['truck_status']='Available';
                                      $item['location']=$movement->end_location;
                                         $truck->update($item);
                                            $driver->update(['available'=>'1']);                             
                                          }

                                         
                                        if(!empty($result)){
                                            $activity = Activity::create(
                                                [ 
                                                    'added_by'=>auth()->user()->id,
                                                    'module_id'=>$movement->pacel_id,
                                                    'module'=>'Cargo',
                                                    'activity'=>"Confirm Delivery",
                                                 'loading_id'=>$id,
                                                    'notes'=>$request->notes,
                                                   'date'=>$request->collection_date,
                                                ]
                                                );                      
                               }
                        
                                        $user_id=auth()->user()->id;
                                        $quotation = CargoLoading::where('status','5')->orwhere('status','6')->get();
                                        $costs = Cost_function::all()->where('user_id',$user_id);
                                       
                                        return redirect(route('order.delivering'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Delivered Successfully']);
                                            break;


                         case 'driver':
              
                                                               
       $route = Route::find($request->route_id); 
  
       $data['route_id']=$request->route_id;
    $data['fuel_rate']=$request->fuel;
        $data['fuel_used']=$route->distance/$request->fuel;
        $data['due_fuel']=$route->distance/$request->fuel;
        $data['added_by']=auth()->user()->id;
        $data['driver_id']=$request->driver_id;
      $data['truck_id']=$request->truck_id;
 $data['status_approve']='0';
        $fuel= Fuel::create($data);


  $items['route_id']=$request->route_id;
   $items['fuel_rate']=$request->mileage;
        $items['total_mileage']=$route->distance * $request->mileage;
       $items['due_mileage']=$route->distance * $request->mileage;
        $items['added_by']=auth()->user()->id;
        $items['driver_id']=$request->driver_id;
      $items['truck_id']=$request->truck_id;
 $items['status_approve']='0';
$items['payment_status']='0';
        $mileage= Mileage ::create($items);

 $driver=Driver::find($request->driver_id);
   $truck=Truck::find($request->truck_id);
     
 $cr= AccountCodes::where('account_name','Mileage')->first();
    $journal = new JournalEntry();
  $journal->account_id = $cr->id;
  $date = explode('-',$mileage->created_at);
  $journal->date =   $mileage->created_at ;
  $journal->year = $date[0];
  $journal->month = $date[1];
 $journal->transaction_type = 'mileage';
  $journal->name = 'Mileage';
  $journal->debit = $mileage->total_mileage ;
  $journal->income_id= $mileage->id;
   $journal->currency_code =  'TZS';
  $journal->exchange_rate= '1';
     $journal->notes= "Mileage to Driver  ". $driver->driver_name ." with Truck ".$truck->truck_name ;
  $journal->save();


  $codes= AccountCodes::where('account_name','Payables')->first();
  $journal = new JournalEntry();
  $journal->account_id = $codes->id;
  $date = explode('-',$mileage->created_at);
  $journal->date =   $mileage->created_at ;
  $journal->year = $date[0];
  $journal->month = $date[1];
   $journal->transaction_type = 'mileage';
  $journal->name = 'Mileage';
   $journal->income_id= $mileage->id;
  $journal->credit =$mileage->total_mileage ;
  $journal->currency_code =  'TZS';
  $journal->exchange_rate= '1';
     $journal->notes= "Mileage  to Driver  ". $driver->driver_name ." with Truck ".$truck->truck_name ;
  $journal->save();


$region=Region::where('name',$route->to)->first();
   $truck->update(['location'=>$region->id]);             
                   
                       
                        return redirect(route('order.return'))->with(['success'=>'Fuel and Mileage Assigned Successfully']);
                            break;


             default:
             return abort(404);
             
            }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

  public function findPrice(Request $request)
    {

              $date = today()->addDays(10)->format('Y-m-d');

               $data=TruckInsurance::leftJoin('stickers', 'stickers.truck_id','truck_insurances.truck_id')
               ->where('truck_insurances.truck_id',$request->id)
               ->where('truck_insurances.expire_date', '<=', $date) 
                 ->orwhere('stickers.truck_id',$request->id)
               ->orwhere('stickers.expire_date', '<=', $date)      
	        ->select('stickers.*','truck_insurances.*')
		->get();
               $id= $request->id;
              if(!empty($data[0])){
                 return response()->json($data);;
               	 }                 

    }



public function report()
    {
 //
        $region = Region::all();
        $report = CargoLoading::get();
      
        return view('order_movement.report',compact('region','report'));
    

    }

 public function findReport (Request $request)
    {

         $data['report'] = CargoLoading::query();

          if(!empty($request->from)){
              $data['report'] = $data['report']->where('start_location',$request->from);
}
 if(!empty($request->to)){
              $data['report'] =$data['report']->where('end_location',$request->to);
}
 if(!empty($request->status)){
              $data['report'] = $data['report']->where('status',$request->status);
}
 if(!empty($request->start_date) && !empty($request->end_date)){
              $data['report'] =$data['report']->whereBetween('created_at',  [$request->start_date, $request->end_date]);
}

$data['report']=$data['report']->get();
            
               $data['region'] = Region::all();

               // return response()->json($report);;
                   return response()->json(['html' => view('order_movement.addreport', $data)->render()]);           

    }



}
