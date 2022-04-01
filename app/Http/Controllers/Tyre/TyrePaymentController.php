<?php

namespace App\Http\Controllers\Tyre;

use App\Http\Controllers\Controller;
use App\Models\Payment_methodes;
use App\Models\Tyre\PurchaseTyre;
use App\Models\Tyre\TyreActivity;
use App\Models\Tyre\TyrePayment;
use Illuminate\Http\Request;

class TyrePaymentController extends Controller
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

        $receipt = $request->all();
        $sales =PurchaseTyre::find($request->purchase_id);

        if(($receipt['amount'] <= $sales->purchase_amount + $sales->purchase_tax)){
            if( $receipt['amount'] >= 0){
                $receipt['trans_id'] = "TRANS_TYRE-".$request->purchase_id.'-'. substr(str_shuffle(1234567890), 0, 1).'-'.$request->date;
                $receipt['added_by'] = auth()->user()->id;
                
                //update due amount from invoice table
                $data['due_amount'] =  $sales->due_amount-$receipt['amount'];
                if($data['due_amount'] != 0 ){
                $data['status'] = 2;
                }else{
                    $data['status'] = 3;
                }
                $sales->update($data);
                 
                $payment = TyrePayment::create($receipt);

                if(!empty($payment)){
                    $activity = TyreActivity::create(
                        [ 
                            'added_by'=>auth()->user()->id,
                            'module_id'=>$payment->id,
                            'module'=>'Purchase Payment',
                            'activity'=>"Purchase Payment Created",
                            'date'=>$request->date,
                        ]
                        );                      
        }

                return redirect(route('purchase_tyre.index'))->with(['success'=>'Payment Added successfully']);
            }else{
                return redirect(route('purchase_tyre.index'))->with(['error'=>'Amount should not be equal or less to zero']);
            }
       

        }else{
            return redirect(route('purchase_tyre.index'))->with(['error'=>'Amount should  be less than Purchase amount ']);

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
        $data=TyrePayment::find($id);
        $invoice = PurchaseTyre::find($data->purchase_id);
        $payment_method = Payment_methodes::all();
       
        return view('tyre.tyre_edit_payment',compact('invoice','payment_method','data','id'));
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

        $payment=TyrePayment::find($id);

        $receipt = $request->all();
        $sales =PurchaseTyre::find($request->purchase_id);
       
        if(($receipt['amount'] <= $sales->purchase_amount + $sales->purchase_tax)){
            if( $receipt['amount'] >= 0){
                $receipt['added_by'] = auth()->user()->id;
                
                //update due amount from invoice table
                if($payment->amount <= $receipt['amount']){
                    $diff=$receipt['amount']-$payment->amount;
                $data['due_amount'] =  $sales->due_amount-$diff;
                }

                if($payment->amount > $receipt['amount']){
                    $diff=$payment->amount - $receipt['amount'];
                $data['due_amount'] =  $sales->due_amount + $diff;
                }
               
                if($data['due_amount'] != 0 ){
                $data['status'] = 2;
                }else{
                    $data['status'] = 3;
                }
                $sales->update($data);
                 
                $payment->update($receipt);

                if(!empty($payment)){
                    $activity = TyreActivity::create(
                        [ 
                            'added_by'=>auth()->user()->id,
                            'module_id'=>$id,
                            'module'=>'Purchase Payment',
                            'activity'=>"Purchase Payment Updated",
                            'date'=>$request->date,
                        ]
                        );                      
        }

                return redirect(route('purchase_tyre.index'))->with(['success'=>'Payment Added successfully']);
            }else{
                return redirect(route('purchase_tyre.index'))->with(['error'=>'Amount should not be equal or less to zero']);
            }
       

        }else{
            return redirect(route('purchase_tyre.index'))->with(['error'=>'Amount should  be less than Purchase amount ']);

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
}
