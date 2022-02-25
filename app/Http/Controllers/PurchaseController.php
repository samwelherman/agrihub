<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supply;
use App\Models\User;
use App\Models\Product;
use App\Models\order;
use App\Models\Balance;
use App\Models\Items;
class PurchaseController extends Controller
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
        $confirmed="confirmed";
        $product=User::find($user_id)->product;
        $supply=User::find($user_id)->supply;
        $name = Items::all();
       return view('purchase.manage_purchase',compact('name'));
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
        $supply=Supply::all();
        $output =order::where('user_id', "=",$user_id)->where('status', "=", $status)->get();
       
        //$arr = array('msg' => 'Your query has been submitted Successfully, we will contact you soon!', 'status' => true,'userdata'=>$output);
    

    return Response()->json(["userdata"=>$output,"product"=>$product,"supply"=>$supply]);

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
        $result=order::create($data);
         
        $purchase=$request->purchase;
        $product_id=$request->product_id;
        $available_stock=Balance::where('product_id','=',$product_id)->get();
        
       
                if(count($available_stock)>0)
                {
                     foreach($available_stock as $stk)
                     {
                         if($product_id==$stk->product_id)
                         {
                            $stock=$stk->purchase+$request->purchase;
                            $update=Balance::where('product_id', '=', $product_id)->update(['purchase' => $stock]);
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
                
        


    //     if($){
    //         //$output=order::find($status)->get;
    //       #Display Success Message in Blade File
    //       //$output=User::find($user_id)->order;
    //       $arr = array('msg' => 'Your query has been submitted Successfully, we will contact you soon!', 'status' => true);
    //   }
  
    //   return Response()->json($arr);
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
    
    public function findPrice(Request $request)
    {
               $price= Price::where('id',$request->id)->get();
                return response()->json($price);	                  

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user_id=auth()->user()->id;

        $update=order::where('user_id', '=', $id)->update(['status' => 'confirmed']);
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
    public function destroy($id,$product,$purchase)
    {
        $user_id=auth()->user()->id;
    
        $data=order::find($id);
        $data->delete();
        // if($data)
        // {
        //     $output=order::all();
        //   #Display Success Message in Blade File
        //   $arr = array('msg' => 'Your query has been submitted Successfully, we will contact you soon!', 'status' => true);
        // }
        
        
        $available_stock=Balance::where('product_id','=',$product)->get();
        if(count($available_stock)>0)
        {
             foreach($available_stock as $stk)
             {
                 if($product==$stk->product_id)
                 {
                    $stock=($stk->purchase)-$purchase;
                    $update=Balance::where('product_id', '=', $product)->update(['purchase' => $stock]);
                      
                       
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
