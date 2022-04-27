<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Sticker;
use App\Models\Truck;
use App\Models\TruckInsurance;
use Illuminate\Http\Request;
use App\Models\Fuel\Fuel;
use App\Models\orders\OrderMovement;
use App\Models\Region;
use App\Models\CargoLoading;


class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $truck = Truck::all(); 
        $driver=Driver::all(); 
  $region = Region::all();          
        return view('truck.truck',compact('truck','driver','region'));
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
        //
        $data = $request->all();
        $data['added_by']=auth()->user()->id;
        $truck= Truck::create($data);
 
        return redirect(route('truck.index'))->with(['success'=>'Truck Created Successfully']);

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
        $data =  Truck::find($id);
        $driver=Driver::all();  
  $region = Region::all();   
        return view('truck.truck',compact('data','id','driver','region'));
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
        $truck =  Truck::find($id);
        $data = $request->all();
        $data['added_by']=auth()->user()->id;
        $truck->update($data);
 
        return redirect(route('truck.index'))->with(['success'=>'Truck Updated Successfully']);
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
        $truck = Truck::find($id);
        $truck->delete();
        return redirect(route('truck.index'))->with(['success'=>'Truck Deleted Successfully']);
    }

    public function insurance($id)
    {
        //
        $truck =  Truck::find($id);
        $insurance=TruckInsurance::where('truck_id',$id)->get();
        $type = "insurance";
        return view('truck.insurance',compact('insurance','type','truck'));
    }
    public function sticker($id)
    {
        //
        $truck =  Truck::find($id);
        $sticker=Sticker::where('truck_id',$id)->get();
        $type = "sticker";
        return view('truck.sticker',compact('sticker','type','truck'));
    }
  public function fuel(Request $request, $id)
    {
        //
        $truck =  Truck::find($id);
      
        $type = "fuel";
         $start_date = $request->start_date;
        $end_date = $request->end_date;
  if(!empty($start_date) || !empty($end_date)){
  $fuel=Fuel::where('truck_id',$id)->whereBetween('created_at',  [$start_date, $end_date])->paginate(10);                            
}

else{
  $fuel=Fuel::where('truck_id',$id)->paginate(10);    
}


        return view('truck.fuel',compact('fuel','type','truck','start_date','end_date'));
    }
  public function route(Request $request, $id)
    {
        //
        $truck =  Truck::find($id);
        $route=CargoLoading::where('truck_id',$id)->get();
        $type = "route";
         $start_date = $request->start_date;
        $end_date = $request->end_date;

        if(!empty($start_date) || !empty($end_date)){
 $route=CargoLoading::where('truck_id',$id)->whereBetween('collection_date', [$start_date, $end_date])->paginate(10);                          
}

else{
 $route=CargoLoading::where('truck_id',$id)->paginate(1);       
}
        return view('truck.route',compact('route','type','truck','start_date','end_date'));
    }

}
