<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Courier\CourierMovement;
use App\Models\Courier\Courier;
use App\Models\Courier\CourierPayment;
use App\Models\Payment_methodes;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Models\AccountCodes;
use App\Models\JournalEntry;

class CourierPaymentController extends Controller
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
        $sales =Courier::find($request->pacel_id);

        if(($receipt['amount'] <= $sales->amount)){
            if( $receipt['amount'] >= 0){
                $random = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(4/strlen($x)) )),1,4);
                $receipt['trans_id'] = "TRANS_CM_".$request->pacel_id.'_'.$random;
                $receipt['added_by'] = auth()->user()->id;
                
                //update due amount from invoice table
                $data['due_amount'] =  $sales->due_amount-$receipt['amount'];
                if($data['due_amount'] != 0 ){
                $data['status'] = 1;
                }else{
                    $data['status'] = 2;
                }
                $sales->update($data);

               
                 
                $payment = CourierPayment::create($receipt);

           $cr= AccountCodes::where('id','$request->account_id')->first();
          $journal = new JournalEntry();
        $journal->account_id = $request->account_id;
        $date = explode('-',$request->date);
        $journal->date =   $request->date ;
        $journal->year = $date[0];
        $journal->month = $date[1];
       $journal->transaction_type = 'courier_payment';
        $journal->name = 'Invoice Payment';
        $journal->debit = $receipt['amount'] *  $sales->exchange_rate;
        $journal->payment_id= $payment->id;
         $journal->currency_code =   $sales->currency_code;
        $journal->exchange_rate=  $sales->exchange_rate;
           $journal->notes= "Courier Payment for Clear Credit  with reference no " .$sales->pacel_number  ;
        $journal->save();


        $codes= AccountCodes::where('account_group','Receivables')->first();
        $journal = new JournalEntry();
        $journal->account_id = $codes->id;
          $date = explode('-',$request->date);
        $journal->date =   $request->date ;
        $journal->year = $date[0];
        $journal->month = $date[1];
       $journal->transaction_type = 'courier_payment';
        $journal->name = 'Invoice Payment';
        $journal->credit =$receipt['amount'] *  $sales->exchange_rate;
          $journal->payment_id= $payment->id;
         $journal->currency_code =   $sales->currency_code;
        $journal->exchange_rate=  $sales->exchange_rate;
           $journal->notes= "Clear Courier Debitor  with reference no " .$sales->pacel_number  ;
        $journal->save();
        


                return redirect(route('courier.invoice'))->with(['success'=>'Payment Added successfully']);
            }else{
                return redirect(route('courier.invoice'))->with(['error'=>'Amount should not be equal or less to zero']);
            }
       

        }else{
            return redirect(route('courier.invoice'))->with(['error'=>'Amount should  be less than Purchase amount ']);

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
        $data=CourierPayment::find($id);
        $invoice = Courier::find($data->pacel_id);
        $payment_method = Payment_methodes::all();
       $bank_accounts=AccountCodes::where('account_group','Cash and Cash Equivalent')->get() ;
        return view('courier.pacel_edit_payment',compact('invoice','payment_method','data','id','bank_accounts'));
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
        $payment=CourierPayment::find($id);

        $receipt = $request->all();
        $sales =Courier::find($request->pacel_id);

        if(($receipt['amount'] <= $sales->amount)){
            if( $receipt['amount'] >= 0){
                $random = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(4/strlen($x)) )),1,4);
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
                $data['status'] = 1;
                }else{
                    $data['status'] = 2;
                }
                $sales->update($data);

              
                 
                $payment->update($receipt);

                         $cr= AccountCodes::where('id','$request->account_id')->first();
          $journal =JournalEntry::where('transaction_type','courier_payment')->where('payment_id', $payment->id)->whereNotNull('debit')->first();
        $journal->account_id = $request->account_id;
        $date = explode('-',$request->date);
        $journal->date =   $request->date ;
        $journal->year = $date[0];
        $journal->month = $date[1];
       $journal->transaction_type = 'courier_payment';
        $journal->name = 'Invoice Payment';
        $journal->debit = $receipt['amount'] *  $sales->exchange_rate;
        $journal->payment_id= $payment->id;
         $journal->currency_code =   $sales->currency_code;
        $journal->exchange_rate=  $sales->exchange_rate;
           $journal->notes= "Courier Payment for Clear Credit  with reference no " .$sales->pacel_number  ;
        $journal->update();


        $codes= AccountCodes::where('account_group','Receivables')->first();
         $journal =JournalEntry::where('transaction_type','courier_payment')->where('payment_id', $payment->id)->whereNotNull('credit')->first();
        $journal->account_id = $codes->id;
          $date = explode('-',$request->date);
        $journal->date =   $request->date ;
        $journal->year = $date[0];
        $journal->month = $date[1];
       $journal->transaction_type = 'courier_payment';
        $journal->name = 'Invoice Payment';
        $journal->credit =$receipt['amount'] *  $sales->exchange_rate;
          $journal->payment_id= $payment->id;
         $journal->currency_code =   $sales->currency_code;
        $journal->exchange_rate=  $sales->exchange_rate;
           $journal->notes= "Clear Courier Creditor  with reference no " .$sales->pacel_number  ;
       $journal->update();

                return redirect(route('courier.invoice'))->with(['success'=>'Payment Added successfully']);
            }else{
                return redirect(route('courier.invoice'))->with(['error'=>'Amount should not be equal or less to zero']);
            }
       

        }else{
            return redirect(route('courier.invoice'))->with(['error'=>'Amount should  be less than Purchase amount ']);

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
