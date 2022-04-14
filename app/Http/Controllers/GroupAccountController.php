<?php

namespace App\Http\Controllers;

use App\Models\GroupAccount;
use App\Models\ClassAccount;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class GroupAccountController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $group = GroupAccount::all();
           $class_account = ClassAccount::all();
        return view('group_account.data', compact('group','class_account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
       $class_account = ClassAccount::all();
        return view('group_account.create', compact('class_account'));
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
            'name' => 'required',
            'group_id' => 'required',
            'class' => 'required'
        ]);
     
      
            $group_account = new GroupAccount();
             $group_account->name = $request->name;
       $group_account->group_id = $request->group_id;
        $group_account->class = $request->class;

  if(!empty($request->class)){
              $class_type=ClassAccount::where('class_name', $request->class)->get();
              foreach($class_type as $class){                        
                        $group_account->type= $class->class_type;
            }
        }
            $group_account->save();
            //Flash::success(trans('general.successfully_saved'));
            return redirect('group_account');
        
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
        $data=  GroupAccount::find($id);
           $class_account = ClassAccount::all();
        return View::make('group_account.data', compact('data','class_account','id'))->render();
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
     
        $group_account = GroupAccount::find($id);
       $group_account->name = $request->name;
       $group_account->group_id = $request->group_id;
        $group_account->class = $request->class;
            if(!empty($request->class)){
              $class_type=ClassAccount::where('class_name', $request->class)->get();
              foreach($class_type as $class){                        
                        $group_account->type= $class->class_type;
            }
        }
        $group_account->save();
        //Flash::success(trans('general.successfully_saved'));
        return redirect('group_account');

 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        GroupAccount::destroy($id);
        //Flash::success(trans('general.successfully_deleted'));
        return redirect('group_account');
    }
}
