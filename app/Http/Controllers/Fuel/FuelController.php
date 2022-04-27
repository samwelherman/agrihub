<?php

namespace App\Http\Controllers\Fuel;

use App\Http\Controllers\Controller;
use App\Models\AccountCodes;
use App\Models\Fuel\Fuel;
use App\Models\Fuel\Refill;
use App\Models\JournalEntry;
use App\Models\Route;
use App\Models\Truck;
use Illuminate\Http\Request;
use App\Models\Expenses;
use App\Models\Region;

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
$region = Region::all();   
        return view('fuel.fuel',compact('truck','route','fuel','refill','region'));
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
                 $bank_accounts=AccountCodes::where('account_group','Cash and Cash Equivalent')->get() ;
                 if($type == 'refill'){
                    return view('fuel.addrefill',compact('id','bank_accounts'));
                
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
   $region = Region::all();   
        return view('fuel.fuel',compact('truck','route','data','id','region'));
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
                $receipt['total_cost'] = $request->price * $request->litres;
                $receipt['fuel_id'] = $id;
                $receipt['added_by'] = auth()->user()->id;
                
                //update due amount from invoice table
                $data['due_fuel'] =  $sales->due_fuel-$receipt['litres'];              
                $sales->update($data);
                $refill = Refill::create($receipt);

           $t=Truck::find($sales->truck_id);

             if($refill->payment_type == 'cash'){            
                $cr= AccountCodes::where('account_name','Fuel')->first();
                $journal = new JournalEntry();
              $journal->account_id = $cr->id;
              $date = explode('-',$refill->created_at);
              $journal->date =   $refill->created_at ;
              $journal->year = $date[0];
              $journal->month = $date[1];
             $journal->transaction_type = 'fuel';
              $journal->name = 'Fuel Refill';
              $journal->debit = $refill->total_cost ;
              $journal->payment_id= $refill->id;
                 $journal->notes= "Fuel Refill for Truck " .$t->truck_name ;
              $journal->save();
      
      

              $journal = new JournalEntry();
              $journal->account_id = $request->account_id;
              $date = explode('-',$refill->created_at);
              $journal->date =   $refill->created_at ;
              $journal->year = $date[0];
              $journal->month = $date[1];
             $journal->transaction_type = 'fuel';
              $journal->name = 'Fuel Refill';
              $journal->credit =$refill->total_cost ;
              $journal->payment_id= $refill->id;
                 $journal->notes= "Payment for Fuel Refill for Truck " .$t->truck_name ;
              $journal->save();
}

    else if($refill->payment_type == 'credit'){
 $account= AccountCodes::where('account_name','Fuel')->first();
$bank= AccountCodes::where('account_name','Payables')->first();

                 $expenses = new Expenses();
            $expenses->name ='Fuel Refill on Credit';
             $expenses->type='Expenses';
       $expenses->amount = $refill->total_cost ;
         $expenses->date  = $refill->created_at  ;
         $expenses->account_id  = $account->id ;
             $expenses->bank_id  = $bank->id;
             $expenses->notes  = "Fuel Refill  on Credit for Truck " .$t->truck_name ;
             $expenses->status  = '0' ;
             $expenses->exchange_code =   'TZS';
             $expenses->exchange_rate=  '1';
             $random = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(4/strlen($x)) )),1,4);
             $expenses->trans_id = "TRANS_EXP_".$random;
             $expenses->added_by = auth()->user()->id;
              $expenses->refill_id =$refill->id;
             $expenses->save();
}


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
    $fuel=  Fuel::find($id);

$refill=Refill::where('fuel_id',$id)->delete();
$fuel->delete();
 return redirect(route('fuel.index'))->with(['success'=>'Fuel Deleted Successfully']);
    }

    public function route(Request $request)
    {
        //
        $data = $request->all();
        if($request->from != $request->to){
        $data['added_by']=auth()->user()->id;
        $route = Route::create($data);
       
       if ($request->ajax()) {
          
           $data = Route::get(['id', 'from','to']);
           return response()->json($route);
       }
    }
}
    public function approve($id)
    {
        //
        $fuel = Fuel::find($id);
        $data['status_approve'] = 1;
    $data['approved_by'] = auth()->user()->id;;
        $data['fuel_used']=$fuel->fuel_used + $fuel->fuel_adjustment;
        $data['due_fuel']=$fuel->due_fuel + $fuel->fuel_adjustment;
        $fuel->update($data);
        return redirect(route('fuel.index'))->with(['success'=>'Approved Successfully']);
    }

}
