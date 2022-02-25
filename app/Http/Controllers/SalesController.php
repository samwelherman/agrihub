<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grocery;
use App\Models\User;
use App\Models\Product;
use App\Models\Items;
use App\Models\Balance;
use App\Models\Sale;
class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user_id=auth()->user()->id;
        //$confirmed="confirmed";
        $product=User::find($user_id)->product;
        $farmer=User::find($user_id)->farmer;
        
        $name = Items::all();
        
       return view("sales.manage_sales",compact('name'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status="unconfirmed";
        $user_id=auth()->user()->id;
        $product=Product::all();
        $farmer=User::find($user_id)->farmer;
        $output =Sale::where('user_id', "=",$user_id)->where('status', "=", $status)->get();
       
        

    return Response()->json(["userdata"=>$output,"product"=>$product,"farmer"=>$farmer]);

        //return json_encode(array('data'=>$userData));
    }

    /**
     * Store a newly created resource in storage.
     *dashboard/
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status='unconfirmed';
        $data=$request->all();
        
        $user_id=auth()->user()->id;
        $data['user_id']=auth()->user()->id;
        $data['status']=$status;
        $result=Sale::create($data);
         
        $sale=$request->sale;
        $product_id=$request->product_id;
        $available_stock=Balance::where('product_id','=',$product_id)->get();
        
       
                if(count($available_stock)>0)
                {
                     foreach($available_stock as $stk)
                     {
                         if($product_id==$stk->product_id)
                         {

                            $stock=$stk->purchase-$request->sale;
                            $new_sales=$stk->sale+$request->sale;
                            $update=Balance::where('product_id', '=', $product_id)->update(['purchase' => $stock,'sale'=>$new_sales]);
                                if($update)
                                {
                                    $arr = array('msg' => 'stock updated', 'status' => true);
                                    
                                }
                         }
                         
                    return Response()->json($arr);
                     }
                    
                }
                else
                {
                    $balance = new Balance();
                    $balance->product_id=$product_id;
                    $balance->user_id=$user_id;
                    $balance->purchase=$purchase;
                    $balance->save();
                    if($balance)
                    {
                        $arr = array('msg' => 'Your query has been submitted Successfully, we will contact you soon!', 'status' => true);
                        
                    }
                    return Response()->json($arr);
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

        $product=Product::where([['user_id',"=",$user_id],['id',"=",$id]])->get();
          #Display Success Message in Blade File
          $arr = array('msg' => 'Purchased product data saved', 'status' => true,"product"=>$product);
        return Response()->json($arr);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        
        $update=Sale::where('user_id', '=', $id)->update(['status' => 'confirmed']);
          #Display Success Message in Blade File
          $arr = array('msg' => 'Purchased product data saved', 'status' => true);
        return Response()->json($arr);
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$product,$sale)
    {
        $user_id=auth()->user()->id;
    
        $data=Sale::find($id);
        $data->delete();
       
        
        $available_stock=Balance::where('product_id','=',$product)->get();
        if(count($available_stock)>0)
        {
             foreach($available_stock as $stk)
             {
                 if($product==$stk->product_id)
                 {
                    $stock=($stk->purchase)+$sale;
                    $new_sales=($stk->similar_text)-$sale;
                    $update=Balance::where('product_id', '=', $product)->update(['purchase' => $stock,'sale'=>$new_sales]);
                      
                       
                 }
                 
            
             }
             $arr = array('msg' => 'stock updated', 'status' => true);
                           
                        
             return Response()->json($arr);
        }
        else
        {
            $arr = array('msg' => 'failed to update', 'status' => true);
                            return Response()->json($arr);
        }
  
     
    }
}
