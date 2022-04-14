<?php

namespace App\Http\Controllers;
use App\Models\ChartOfAccount;
use App\Models\GroupAccount;
use App\Models\ClassAccount;
use App\Models\AccountCodes;
use App\Models\Expenses;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Models\JournalEntry;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class ExpensesController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      $expense = Expenses::all();

 $bank_accounts=AccountCodes::where('account_group','Cash and Cash Equivalent')->get() ;
     $chart_of_accounts =AccountCodes::where('account_group','!=','Cash and Cash Equivalent')->get() ;
       
          $group_account = GroupAccount::all();
        return view('expenses.data', compact('expense','group_account','chart_of_accounts','bank_accounts'));
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

            $expenses = new Expenses();
            $expenses->name = $request->name;
             $expenses->type='Expenses';
       $expenses->amount = $request->amount ;
         $expenses->date  = $request->date  ;
         $expenses->account_id  = $request->account_id  ;
             $expenses->bank_id  = $request->bank_id ;
             $expenses->notes  = $request->notes ;

             $expenses->save();

         $journal = new JournalEntry();
        $journal->account_id =    $expenses->account_id;
      $date = explode('-',  $expenses->date);
        $journal->date = $expenses->date;
        $journal->year = $date[0];
        $journal->month = $date[1];
        $journal->transaction_type = 'expense_payment';
        $journal->name = 'Expense Payment';
             $journal->expense_id=    $expenses->id;
              $journal->notes= 'Expense Payment' ;
        $journal->debit =   $expenses->amount;
        $journal->save();

         $journal = new JournalEntry();
        $journal->account_id = $expenses->bank_id;
        $date = explode('-',  $expenses->date);
        $journal->date = $expenses->date;
        $journal->year = $date[0];
        $journal->month = $date[1];
        $journal->transaction_type = 'expense_payment';
        $journal->name = 'Expense Payment';
        $journal->credit =    $expenses->amount;
        $journal->expense_id=    $expenses->id;
           $journal->notes= 'Expense Payment';
        $journal->save();

            return redirect('expenses');
        }
   

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
       $data= Expenses::find($id);


 $bank_accounts=AccountCodes::where('account_group','Cash and Cash Equivalent')->get() ;
     $chart_of_accounts =AccountCodes::where('account_group','!=','Cash and Cash Equivalent')->get() ;
   

            $group_account = GroupAccount::all();
        return View::make('expenses.data', compact('data','group_account','id','chart_of_accounts','bank_accounts'))->render();
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
       
          $expenses= Expenses::find($id);
            $expenses->name = $request->name;
             $expenses->type='Expenses';
       $expenses->amount = $request->amount ;
         $expenses->date  = $request->date  ;
         $expenses->account_id  = $request->account_id  ;
             $expenses->bank_id  = $request->bank_id ;
             $expenses->notes  = $request->notes ;
  
      
            $expenses->save();

        //Flash::success(trans('general.successfully_saved'));
        return redirect('expenses');
     
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        Expenses::destroy($id);
        //Flash::success(trans('general.successfully_deleted'));
        return redirect('expenses');
    }
}
