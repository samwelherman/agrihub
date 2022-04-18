<?php

namespace App\Http\Controllers;
use App\Models\ChartOfAccount;
use App\Models\GroupAccount;
use App\Models\ClassAccount;
use App\Models\AccountCodes;
use App\Models\Expenses;
use App\Models\Deposit;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Models\JournalEntry;
use App\Http\Requests;
use App\Models\Currency;
use App\Models\Payment_methodes;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class DepositController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      $deposit = Deposit::all();
      $payment_method = Payment_methodes::all();
 $bank_accounts=AccountCodes::where('account_group','Cash and Cash Equivalent')->get() ;
     $chart_of_accounts =AccountCodes::where('account_group','!=','Cash and Cash Equivalent')->get() ;
     $currency = Currency::all();
          $group_account = GroupAccount::all();
        return view('deposit.data', compact('currency','deposit','group_account','payment_method','chart_of_accounts','bank_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
       $group_account = GroupAccount::all();
        return view('account_codes.create', compact('group_account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $deposit = new Deposit();
            $deposit->name = $request->name;
       $deposit->amount = $request->amount ;
         $deposit->date  = $request->date  ;
         $deposit->account_id  = $request->account_id  ;
             $deposit->bank_id  = $request->bank_id ;
             $deposit->notes  = $request->notes ;
             $deposit->status  = '0' ;
             $deposit->exchange_code =   $request->exchange_code;
             $deposit->exchange_rate=  $request->exchange_rate;
             $random = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(4/strlen($x)) )),1,4);
             $deposit->trans_id = "TRANS_DEP_".$random;
             $deposit->type=' Deposit';
             $deposit->added_by = auth()->user()->id;
             $deposit->payment_method =  $request->payment_method;
             $deposit->save();

       

            return redirect('deposit');
        }
   

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
       $data= Deposit::find($id);


 $bank_accounts=AccountCodes::where('account_group','Cash and Cash Equivalent')->get() ;
     $chart_of_accounts =AccountCodes::where('account_group','!=','Cash and Cash Equivalent')->get() ;
     $currency = Currency::all();
     $payment_method = Payment_methodes::all();
            $group_account = GroupAccount::all();
        return View::make('deposit.data', compact('data','currency','group_account','id','payment_method','chart_of_accounts','bank_accounts'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
          $deposit= Deposit::find($id);
            $deposit->name = $request->name;
       $deposit->amount = $request->amount ;
         $deposit->date  = $request->date  ;
         $deposit->account_id  = $request->account_id  ;
             $deposit->bank_id  = $request->bank_id ;
             $deposit->notes  = $request->notes ;
             $deposit->status  = '0' ;
             $deposit->exchange_code =   $request->exchange_code;
             $deposit->exchange_rate=  $request->exchange_rate;
             $deposit->type=' Deposit';
             $deposit->added_by = auth()->user()->id;
             $deposit->payment_method =  $request->payment_method;
            $deposit->save();

        //Flash::success(trans('general.successfully_saved'));
        return redirect('deposit');
     
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        Deposit::destroy($id);
        //Flash::success(trans('general.successfully_deleted'));
        return redirect('deposit');
    }

    public function approve($id)
    {
        //
        $deposit= Deposit::find($id);
        $data['status'] = 1;
        $deposit->update($data);

        $journal = new JournalEntry();
        $journal->account_id = $deposit->bank_id;
        $date = explode('-',  $deposit->date);
        $journal->date = $deposit->date;
        $journal->year = $date[0];
        $journal->month = $date[1];
        $journal->transaction_type = 'deposit';
        $journal->name = 'Deposit Payment';
        $journal->payment_id =    $deposit->id;
        $journal->notes= 'Deposit Payment with transaction id ' .$deposit->trans_id;
        $journal->debit=    $deposit->amount * $deposit->exchange_rate;
        $journal->currency_code =   $deposit->exchange_code;
        $journal->exchange_rate=  $deposit->exchange_rate;
        $journal->save();

        $journal = new JournalEntry();
        $journal->account_id =    $deposit->account_id;
         $date = explode('-',  $deposit->date);
        $journal->date = $deposit->date;
        $journal->year = $date[0];
        $journal->month = $date[1];
        $journal->transaction_type = 'deposit';
        $journal->name = 'Deposit Payment';
        $journal->payment_id =    $deposit->id;
        $journal->notes= 'Deposit Payment with transaction id ' .$deposit->trans_id;
        $journal->credit=   $deposit->amount * $deposit->exchange_rate;
        $journal->currency_code =   $deposit->exchange_code;
        $journal->exchange_rate=  $deposit->exchange_rate;
        $journal->save();
    
       


      

        return redirect(route('deposit.index'))->with(['success'=>'Approved Successfully']);
    }

   
}
