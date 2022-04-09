<?php

namespace App\Http\Controllers\Api_controllers\Logistic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Truck;
use App\Models\Driver;
class Driver_Management_ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $user_id=auth()->user()->id;
        $drivers=Driver::where('added_by',$user_id)->get();
        $response=['success'=>true,'error'=>false,'message'=>'successfully','drivers'=>$drivers];
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $this->validate($request,[
        //     'warehouse_id'=>'required',
        //     'quantity'=>'required',
        //     'user_id'=>'required',
        //     'client_id'=>'required',
        //     'offer_amount'=>'required',
        //     'crop_type'=>'required',
        //     'start_location'=>'required',
        //     'end_location'=>'required',
        //     'route_type'=>'requied',
        //     'status'=>'required'
        // ]); 
        // $user_id=auth()->user()->id;
        // $order= new Order();
        // $order->warehouse_id=$request->input('warehouse_id');
        // $order->quantity=$request->input('quantity');
        // $order->client_id=$user_id;
        // $order->user_id=0;
        // $order->offered_amount=$request->input('offer_amount');
        // $order->crop_type=$request->input('crop_type');
        // $order->start_location=$request->input('start_location');
        // $order->end_location=$request->input('end_location');
        // $order->route_type=1;
        // $order->status=1;
        // $order->save();
        // if($order)
        // {
        //     return response()
        //     ->json(" Order created successfull");
        // }
        // else
        // {
        //     return ;
        // }

      
    }
    
    
   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $orders =Order::with('crop_types','user','warehouse')->where('warehouse_id', "=", $id)->get();
        // if($orders)
        // {
        // return response()
        // ->json($orders);
        // }
        // else
        // {
        //     return ;
        // }
        
    } 
    
  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
      
        
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
       
        $user_id=auth()->user()->id;
        $order= Order::find($id);
        $order->user_id=$user_id;
        $order->logistic_id=$user_id;
        $order->status=2;
        $order->update();
        if($order){
            return response()
            ->json(" Order updated successfuly");
        }
        else{
            return response()
            ->json(" Order updated fail");
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
       
    }
}