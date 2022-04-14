<?php

namespace App\Http\Controllers;

use App\Models\ClassAccount;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Alert;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class ClassAccountController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $class = ClassAccount::all();
        return view('class_account.data', compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('class_account.create', compact(''));
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
            'class_name' => 'required',
            'class_id' => 'required',
            'class_type' => 'required', 
          
        ]);
            $class_account = new ClassAccount();
            $class_account->class_name = $request->class_name;
            $class_account->class_id = $request->class_id;
            $class_account->class_type = $request->class_type;
            $class_account->save();
          // Alert::success('class account created');
              return redirect('class_account');
           
        
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
        $data =   ClassAccount::find($id);
        return View::make('class_account.data', compact('data','id'))->render();
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
      
        $class_account = ClassAccount::find($id);
       $class_account->class_name = $request->class_name;
       $class_account->class_id = $request->class_id;
        $class_account->class_type = $request->class_type;
        $class_account->save();
        //Flash::success(trans('general.successfully_saved'));
        return redirect('class_account');

 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        ClassAccount::destroy($id);
        //Flash::success(trans('general.successfully_deleted'));
        return redirect('class_account');
    }
}
