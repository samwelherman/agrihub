<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmer;
use App\Models\Warehouse;
use App\Models\Insurance;
use App\Models\User;
use App\Models\Farmer_account;
use App\Models\Deposite_withdraw;
use App\Models\Crops_type;
use App\Models\Group;
use App\Models\Order;
class Orders_Client_ManipulationsController extends Controller
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
        
        $data = Farmer_account::groupBy('warehouse_id','crops_type_id')->selectRaw('sum(total_quantity) as total_quantity, warehouse_id,crops_type_id')->with(['crops_type','warehouse'])->get();
       
            return response()
            ->json($data);
        
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
      
        $order= new Order();
        $order->warehouse_id=$request->input('warehouse_id');
        $order->quantity=$request->input('quantity');
        $order->user_id=$request->input('user_id');
        $order->offered_amount=$request->input('offer_amount');
        $order->crop_type=$request->input('crop_type');
        $order->start_location=$request->input('start_location');
        $order->end_location=$request->input('end_location');
        $order->route_type=$request->input('route_type');
        $order->status=$request->input('status');
        $order->save();
        if($order)
        {
            return response()
            ->json($order);
        }
        else
        {
            return ;
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