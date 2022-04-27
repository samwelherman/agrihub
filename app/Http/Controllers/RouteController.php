<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Region;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
   {
       //
   $region = Region::all();   
       $route = Route::all();     
       return view('route.route',compact('route','region'));
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
 if($request->from != $request->to){
      $data=$request->post();
      $data['added_by']=auth()->user()->id;
      $route = Route::create($data);

      return redirect(route('routes.index'))->with(['success'=>'Route Created Successfully']);
}

else{
    return redirect(route('routes.index'))->with(['error'=>'Start Point and Destination Point cannot be the same']);

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
 $region = Region::all(); 
       $data =  Route::find($id);
       return view('route.route',compact('data','id','region'));

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
       $route = Route::find($id);
      if($request->from != $request->to){
       $data=$request->post();
       $data['added_by']=auth()->user()->id;
       $route->update($data);

       return redirect(route('routes.index'))->with(['success'=>'Route Updated Successfully']);

}else{
    return redirect(route('routes.index'))->with(['error'=>'Start Point and Destination Point cannot be the same']);

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

       $route = Route::find($id);
       $route->delete();

       return redirect(route('route.index'))->with(['success'=>'Route Deleted Successfully']);
   }
}
