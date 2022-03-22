<?php

namespace App\Http\Controllers\Activity;

use App\Http\Controllers\Controller;
use App\Models\orders\Activity;
use App\Models\orders\Cost_function;
use App\Models\orders\OrderMovement;
use App\Models\orders\Order;
use Illuminate\Http\Request;

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
    public function show($id,Request $request)
    {
        //
        switch ($request->type) {
            case 'collection':
                    return view('order_movement.addcollection',compact('id'));
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
          $quotation = OrderMovement::where('status','2')->get();
          //$quotation = Order::where('status','2')->get();
        $costs = Cost_function::all()->where('user_id',$user_id);

        return view('order_movement.collection',compact('quotation','costs'));

    }

    public function loading(){
        $user_id=auth()->user()->id;
        $quotation = OrderMovement::where('status','3')->get();
        $costs = Cost_function::all()->where('user_id',$user_id);

        return view('order_movement.loading',compact('quotation','costs'));

    }

    public function offloading(){
        $user_id=auth()->user()->id;
        $quotation = OrderMovement::where('status','4')->get();
        $costs = Cost_function::all()->where('user_id',$user_id);
       
        return view('order_movement.offloading',compact('quotation','costs'));

    }

    public function delivering(){
        $user_id=auth()->user()->id;
        $quotation = OrderMovement::where('status','5')->orwhere('status','6')->get();
        $costs = Cost_function::all()->where('user_id',$user_id);

        return view('order_movement.delivering',compact('quotation','costs'));

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
                $movement=OrderMovement::find($id);
                $result=$movement->update(['status'=>3]);
                 
                if(!empty($result)){
                    $activity = Activity::create(
                        [ 
                            'added_by'=>auth()->user()->id,
                            'transport_id'=>$movement->transport_id,
                            'activity'=>"Confirm Collection",
                            'notes'=>$request->notes,
                           'date'=>$request->collection_date,
                        ]
                        );                      
       }

                $user_id=auth()->user()->id;
                $quotation = OrderMovement::where('status','3')->get();
                $costs = Cost_function::all()->where('user_id',$user_id);
               
                return redirect(route('order.loading'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Collected Successfully']);
                    break;

                    case 'loading':
                        $movement=OrderMovement::find($id);
                        $result=$movement->update(['status'=>4,'truck'=>$request->truck]);
                         
                        if(!empty($result)){
                            $activity = Activity::create(
                                [ 
                                    'added_by'=>auth()->user()->id,
                                    'transport_id'=>$movement->transport_id,
                                    'activity'=>"Confirm Loading",
                                    'notes'=>$request->notes,
                                   'date'=>$request->collection_date,
                                ]
                                );                      
               }
        
                        $user_id=auth()->user()->id;
                        $quotation = OrderMovement::where('status','4')->get();
                        $costs = Cost_function::all()->where('user_id',$user_id);
                       
                        return redirect(route('order.offloading'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Loaded Successfully']);
                            break;

                            case 'offloading':
                                $movement=OrderMovement::find($id);
                                $result=$movement->update(['status'=>5]);
                                 
                                if(!empty($result)){
                                    $activity = Activity::create(
                                        [ 
                                            'added_by'=>auth()->user()->id,
                                            'transport_id'=>$movement->transport_id,
                                            'activity'=>"Confirm Offloading",
                                            'notes'=>$request->notes,
                                           'date'=>$request->collection_date,
                                        ]
                                        );                      
                       }
                
                                $user_id=auth()->user()->id;
                                $quotation = OrderMovement::where('status','5')->get();
                                $costs = Cost_function::all()->where('user_id',$user_id);
                               
                                return redirect(route('order.delivering'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Offloaded Successfully']);
                                    break;

                                    case 'delivering':
                                        $movement=OrderMovement::find($id);
                                        $result=$movement->update(['status'=>6]);
                                         
                                        if(!empty($result)){
                                            $activity = Activity::create(
                                                [ 
                                                    'added_by'=>auth()->user()->id,
                                                    'transport_id'=>$movement->transport_id,
                                                    'activity'=>"Confirm Delivery",
                                                    'notes'=>$request->notes,
                                                   'date'=>$request->collection_date,
                                                ]
                                                );                      
                               }
                        
                                        $user_id=auth()->user()->id;
                                        $quotation = OrderMovement::where('status','5')->orwhere('status','6')->get();
                                        $costs = Cost_function::all()->where('user_id',$user_id);
                                       
                                        return redirect(route('order.delivering'))->with(['quotation'=> $quotation,'costs'=>$costs,'success'=>'Delivered Successfully']);
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
}
