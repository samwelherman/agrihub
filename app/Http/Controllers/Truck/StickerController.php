<?php

namespace App\Http\Controllers\Truck;

use App\Http\Controllers\Controller;
use App\Models\Sticker;
use App\Models\Truck;
use Illuminate\Http\Request;

class StickerController extends Controller
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
        $data = $request->all();
        $data['added_by']=auth()->user()->id;
        $truck= Sticker::create($data);
  
        return redirect(route('truck.sticker', $request->truck_id))->with(['success'=>"Truck Sticker Created Successfully",'type'=>"sticker"]);
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
        $data =  Sticker::find($id);      
        $truck=  Truck::where('id',$data->truck_id)->first();
        $type = "edit-sticker";
        return view('truck.sticker',compact('data','id','type','truck'));
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
        $truck= Sticker::find($id);   

        $data = $request->all();   
        $data['added_by']=auth()->user()->id;

       
        $truck->update($data);
 
        return redirect(route('truck.sticker', $request->truck_id))->with(['success'=>"Truck Sticker' Updated Successfully",'type'=>"sticker'"]);
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
        $truck= Sticker::find($id);
       
        $truck->delete();
        return redirect(route('truck.sticker'))->with(['success'=>"Sticker Deleted Successfully",'type'=>"sticker"]);
    }
}
