<?php

namespace App\Http\Controllers;
use App\Models\ChartOfAccount;
use App\Models\GroupAccount;
use App\Models\ClassAccount;
use App\Models\AccountCodes;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class AccountCodesController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $codes = AccountCodes::all();
          $group_account = GroupAccount::all();
        return view('account_codes.data', compact('codes','group_account'));
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
      
       $validatedData = $request->validate([
              'account_codes' => 'required',
            'account_name' => 'required',
            'account_group' => 'required',
              'account_status' => 'required',
        ]);
     
      
            $account_codes = new AccountCodes();
             $account_codes->account_codes = $request->account_codes;
       $account_codes->account_name = $request->account_name ;
        $account_codes->account_group  = $request->account_group  ;
        $account_codes->account_status  = $request->account_status  ;
              if(!empty($request->account_group)){
              $group_type=GroupAccount::where('name', $request->account_group)->get();
              foreach($group_type as $group){                        
                        $account_codes->account_type= $group->type;
            }
        }
           
            $account_codes->save();

            AccountCodes::where('id',$account_codes->id)->update(['account_id' => $account_codes->id]);
              $chart_of_account = new ChartOfAccount();
              $chart_of_account->id =  $account_codes->id;
             $chart_of_account->account_codes = $request->account_codes;
            $chart_of_account->account_name = $request->account_name ;
               $chart_of_account->name = $request->account_name ;
                $chart_of_account->gl_code = $request->account_codes;
           $chart_of_account->account_type =     $account_codes->account_type ;
              $chart_of_account->active = $request->account_status  ;
            $chart_of_account->save();
            
            
            //Flash::success(trans('general.successfully_saved'));
            return redirect('account_codes');
        }
   

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
       $data= AccountCodes::find($id);
            $group_account = GroupAccount::all();
        return View::make('account_codes.data', compact('data','group_account','id'))->render();
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
       
         $account_codes= AccountCodes::find($id);
         $account_codes->account_codes = $request->account_codes;
       $account_codes->account_name = $request->account_name ;
        $account_codes->account_group  = $request->account_group  ;
        $account_codes->account_status  = $request->account_status  ;
      if(!empty($request->account_group)){
              $group_type=GroupAccount::where('name', $request->account_group)->get();
              foreach($group_type as $group){                        
                        $account_codes->account_type= $group->type;
            }
        }
           
            $account_codes->save();

          ChartOfAccount::where('id',$account_codes->id)->update([
              'account_codes' =>$request->account_codes,
              'account_name' =>$request->account_name,
              'account_type' => $account_codes->account_type,
                 'name' =>$request->account_name,
                  'gl_code' =>$request->account_codes,
                    'active' =>$request->account_status,
          ]);
        //Flash::success(trans('general.successfully_saved'));
        return redirect('account_codes');
  

        
            
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        AccountCodes::destroy($id);
          ChartOfAccount::where('id',$id)->delete();
        //Flash::success(trans('general.successfully_deleted'));
        return redirect('account_codes');
    }
}
