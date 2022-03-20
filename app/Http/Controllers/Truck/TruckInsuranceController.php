<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Models\Truck;
use App\Models\TruckInsurance;
use Illuminate\Http\Request;

class TruckInsuranceController extends Controller
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
        $data = $request->all();
        $data['added_by']=auth()->user()->id;
        $truck= TruckInsurance::create($data);
  
        return redirect(route('truck.insurance', $request->truck_id))->with(['success'=>"Truck Insurance Created Successfully",'type'=>"insurance"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $data =  TruckInsurance::find($id);      
        $truck=  Truck::where('id',$data->truck_id)->first();
        $type = "edit-insurance";
        return view('truck.insurance',compact('data','id','type','truck'));
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
        $truck= TruckInsurance::find($id);   

        $data = $request->all();   
        $data['added_by']=auth()->user()->id;

       
        $truck->update($data);
 
        return redirect(route('truck.insurance', $request->truck_id))->with(['success'=>"Truck Insurance Updated Successfully",'type'=>"insurance"]);
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
        $truck= TruckInsurance::find($id);
       
        $truck->delete();
        return redirect(route('truck.insurance'))->with(['success'=>"Licence Deleted Successfully",'type'=>"insurance"]);
    }
}
