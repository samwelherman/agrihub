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
class WarehouseController extends Controller
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
        $warehouse =Warehouse::all();
        $user=User::all();
        $insurance=Insurance::all();
        $group=USer::find($user_id)->group;
        
        return view('warehouses.manage-warehouse')->with('insurances',$insurance)->with('warehouse',$warehouse)->with('farmer',$warehouse)->with('users',$user);
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
        
       
      
    }
    
    //function for adding insurance
    
    public function storeInsurance(Request $request)
    {
        
        $this->validate($request,[
            'insurancename'=>'required',
            'insuranceamount'=>'required',
            'assetvalue'=>'required',
            'insurancetype'=>'required',
            'coveringage'=>'required',
            'startdate'=>'required',
            'enddate'=>'required'
        ]); 
        
        //$data=$this->request();
        //$data['user_id'] =auth()->user()->id;
        //$farmer= Farmer::create($data);
      
        $insurance= new Insurance();

        $insurance->insurance_name=$request->input('insurancename');
        $insurance->insurance_amount=$request->input('insuranceamount');
        $insurance->asset_value=$request->input('assetvalue');
        $insurance->insurance_type=$request->input('insurancetype');
        $insurance->cover_age=$request->input('coveringage');
        $insurance->start_date=$request->input('startdate');
        $insurance->end_date=$request->input('enddate');
      
        $insurance->save();
        if($insurance)
        {
            $messagev="New insurance is registered successful'";
            return redirect('/warehouse')->with('messagev',$messagev);
        }
        else
        {
            $messager="Failed to register new insurance'";
            return redirect('/warehouse')->with('messager',$messager);
        }

    }
    
    
    //function for creating farmer account
    
    public function storeFarmerAccount(Request $request)
    {
        
        $this->validate($request,[
            'cropstype'=>'required',
            'selectfamer'=>'required',
        ]); 
        
       
        $warehouseid=$request->input('warehouseid');
      
        $farmerAccount= new Farmer_account();

        $farmerAccount->crops_type_id=$request->input('cropstype');
        $farmerAccount->farmer_id=$request->input('selectfamer');
        $farmerAccount->warehouse_id=$request->input('warehouseid');
       
        $farmerAccount->save();
        if($farmerAccount)
        {
            $messagev="New Farmer Account is registered successful'";
            return redirect("/warehouse/{$warehouseid}/show")->with('messagev',$messagev);
        }
        else
        {
            $messager="Failed to register new Farmer Account'";
            return redirect("/warehouse/{$warehouseid}/show")->with('messager',$messager);
        }

    }
    
    //function for deposity
    
    public function storedeposity(Request $request)
    {
        $id =$request->input('account_id');
       
        $farmerAccount=Farmer_account::find($id);
        
        $this->validate($request,[
            'deposityquantity'=>'required',
        ]); 
        
        $warehouseid=$request->input('warehouseid');
      
        $accountBalance=$farmerAccount->total_quantity;
        $accountBalance =$accountBalance+$request->input('deposityquantity');
        
      $farmerAccount->update(['total_quantity' => $accountBalance]);
      if($farmerAccount){
          $deposity= new Deposite_withdraw();

        $deposity->farm_account_id=$request->input('account_id');
        $deposity->quantity=$request->input('deposityquantity');
         $deposity->cost=$request->input('deposityprice');
         $deposity->warehouse_id=$request->input('warehouseid');
        $deposity->status=2;
       
        $deposity->save();
        if($deposity)
        {
            $messagev="deposity successful'";
            return redirect("/warehouse/{$warehouseid}/show")->with('messagev',$messagev);
        }
        else
        {
            $messager="Failed to deposity";
            return redirect("/warehouse/{$warehouseid}/show")->with('messager',$messager);
        }
 
      }
       
    }
    //function for withdraw
    
    public function storewithdraw(Request $request)
    {
        
        $this->validate($request,[
            'withquantity'=>'required',
        ]); 
         $warehouseid=$request->input('warehouseid');
         
          $id =$request->input('account_id');
       
        $farmerAccount=Farmer_account::find($id);
        $withdrawamount =$request->input('withquantity');
        
        
         $accountBalance=$farmerAccount->total_quantity;
         if($accountBalance>$withdrawamount){
        $accountBalance =$accountBalance-$withdrawamount;
        
         $farmerAccount->update(['total_quantity' => $accountBalance]);
      if($farmerAccount){
        $withdraw= new Deposite_withdraw();

        $withdraw->farm_account_id=$request->input('account_id');;
        $withdraw->quantity=$request->input('withquantity');
         $withdraw->cost=$request->input('deposityprice');
          $withdraw->warehouse_id=$request->input('warehouseid');
        $withdraw->status=1;
       
        $withdraw->save();
         if($withdraw)
        {
            $messagev="withdraw successful'";
            return redirect("/warehouse/{$warehouseid}/show")->with('messagev',$messagev);
        } else
        {
            $messager="Failed to withdraw";
            return redirect("/warehouse/{$warehouseid}/show")->with('messager',$messager);
        }}
        else
        {
            $messager="Failed to withdraw";
            return redirect("/warehouse/{$warehouseid}/show")->with('messager',$messager);
        }
         }else{
             $messager="Failed to withdraw you have no balance";
            return redirect("/warehouse/{$warehouseid}/show")->with('messager',$messager); 
         }
      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id=auth()->user()->id;
        // $wihdrawHistory=Deposite_withdraw::join('posts', 'posts.user_id', '=', 'users.id')
        // ->join('comments', 'comments.post_id', '=', 'posts.id')
        // ->get(['users.*', 'posts.descrption']);all()->where('status',1)->where('warehouse_id',$id);
        $wihdrawHistory=Deposite_withdraw::with(['farmer_account'])->where('status',1)->where('warehouse_id',$id)->get();
        $deposityHistory=Deposite_withdraw::with(['farmer_account'])->where('status',2)->where('warehouse_id',$id)->get();
        $warehouse=Warehouse::find($id);
        $warehouses=Warehouse::all();
        $crops_type=Crops_type::all();
        $farmer=Farmer::all();
        $account=Farmer_account::with(['farmer','crops_type'])->where('warehouse_id',$id)->get();
    
        $group=User::find($user_id)->group;
        if(!empty($warehouse))
        {
        
    
        return view('warehouses.manage-single-warehouse')->with('farmer',$farmer)->with('accounts',$account)->with('warehouse',$warehouse)->with('deposity',$deposityHistory)->with('withdraw',$wihdrawHistory)->with('crops_types',$crops_type);

        }
        else
        {
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
    public function destroy($id)
    {
       
    }
}