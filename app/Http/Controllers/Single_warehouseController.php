<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crops_Monitoring;
use App\Models\Land_properties;
use App\Models\Monitoring_type;
use App\Models\Monitoring_Solutions;

class Single_warehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
      $warehouse_id = $request->warehouse_id;
       switch ($request->type) {
        case 'withdraw':
                return view('warehouses.withdraw-form',compact('warehouse_id','id'));
                break;
        case 'deposity':
         
                return view('warehouses.deposity-form',compact('warehouse_id','id'));
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
     
     public function download(Request $request)
{
   
}

    public function destroy($id)
    {
      
    }
}
