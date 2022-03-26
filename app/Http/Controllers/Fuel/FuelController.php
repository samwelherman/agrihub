<?php

namespace App\Http\Controllers\Fuel;

use App\Http\Controllers\Controller;
use App\Models\Fuel\Fuel;
use App\Models\Fuel\Refill;
use App\Models\Route;
use App\Models\Truck;
use Illuminate\Http\Request;

class FuelController extends Controller
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
        $route=Route::all();    
        $fuel = Fuel::all();    
        $refill=Refill::all(); 
        return view('fuel.fuel',compact('truck','route','fuel','refill'));
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
        $route=Route::where('id',$request->route_id)->first();
        $data['fuel_used']=$route->distance/$request->fuel_rate;
        $data['due_fuel']=$route->distance/$request->fuel_rate;
        $data['added_by']=auth()->user()->id;
        $fuel= Fuel::create($data);
 
        return redirect(route('fuel.index'))->with(['success'=>'Fuel Created Successfully']);
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

    public function discountModal(Request $request)
    {
                 $id=$request->id;
                 $type = $request->type;
                 if($type == 'refill'){
                    return view('fuel.addrefill',compact('id'));
                
                 }elseif($type == 'adjustment'){
                    $data =  Fuel::find($id);
                 return view('fuel.addadjustment',compact('id','data'));  
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
        $data =  Fuel::find($id);
        $truck = Truck::all(); 
        $route=Route::all();    
   
        return view('fuel.fuel',compact('truck','route','data','id'));
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
        $fuel=  Fuel::find($id);

        if($request->type == 'adjustment'){
            $adjust =  Fuel::find($id);
            $item['fuel_adjustment']=$request->fuel_adjustment;
            $item['reason']=$request->reason;
            $item['status_approve']='0';
            $adjust->update($item);

            return redirect(route('fuel.index'))->with(['success'=>'Fuel Adjustment Updated Successfully']);

        }

        if($request->type == 'refill'){
        $receipt = $request->all();
        $sales =Fuel::find($id);

        if(($receipt['litres'] <= $sales->due_fuel)){
            if($receipt['litres'] >= 0){
                $receipt['truck'] = $sales->truck_id;
                $receipt['route'] = $sales->route_id;
                $receipt['fuel_id'] = $id;
                $receipt['added_by'] = auth()->user()->id;
                
                //update due amount from invoice table
                $data['due_fuel'] =  $sales->due_fuel-$receipt['litres'];              
                $sales->update($data);
                $refill = Refill::create($receipt);

                return redirect(route('fuel.index'))->with(['success'=>'Fuel Refill Updated Successfully']);

                
            }else{
                return redirect(route('fuel.index'))->with(['error'=>'Amount should not be equal or less to zero']);          
            }
       

        }else{
            return redirect(route('fuel.index'))->with(['error'=>'Amount should  be less than Fuel Used']);
            
        }

    }

        else{
        $data = $request->all();
        $route=Route::where('id',$request->route_id)->first();
        $data['fuel_used']=$route->distance/$request->fuel_rate;
        $data['due_fuel']=$route->distance/$request->fuel_rate;
        $data['added_by']=auth()->user()->id;
        $fuel->update($data);
        return redirect(route('fuel.index'))->with(['success'=>'Fuel Updated Successfully']);

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

    public function route(Request $request)
    {
        //
        $data = $request->all();
        $data['added_by']=auth()->user()->id;
        $route = Route::create($data);
       
       if ($request->ajax()) {
          
           $data = Route::get(['id', 'from','to']);
           return response()->json($route);
       }
    }

    public function approve($id)
    {
        //
        $fuel = Fuel::find($id);
        $data['status_approve'] = 1;
        $data['fuel_used']=$fuel->fuel_used + $fuel->fuel_adjustment;
        $data['due_fuel']=$fuel->due_fuel + $fuel->fuel_adjustment;
        $fuel->update($data);
        return redirect(route('fuel.index'))->with(['success'=>'Approved Successfully']);
    }

}
