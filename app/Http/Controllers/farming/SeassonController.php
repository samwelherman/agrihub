<?php

namespace App\Http\Controllers\farming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\farming\Seasson;
use App\Models\farming\Preparation_cost;
use App\Models\farming\PreparationDetails;

class SeassonController extends Controller
{
    

    public function index()
    {
        //
        $user_id = auth()->user()->id;
        $seasson = Seasson::all()->where('user_id',$user_id);

        return view('farming_process.manage_seasson',compact('seasson'));
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
        $user_id = auth()->user()->id;
        $data = $request->all();
        $data['user_id'] = $user_id;
        $season = Seasson::create($data);

        return redirect(Route('seasson.index'))->with(['success'=>'Seasson Created Seccessfully']);
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
        $name = Preparation_cost::all();

        $preparationDetails = PreparationDetails::all();
        $type = "view-preparation";
        
        return view('farming_process.crop_life_cycle',compact('name','id','preparationDetails','type'));

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
        $data = Seasson::find($id);

        return view('farming_process.manage_seasson',compact('data','id'));    }

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
        $user_id = auth()->user()->id;
        $data = $request->all();
        $data['user_id'] = $user_id;
        $season = Seasson::find($id);
        $season->update($data);

        return redirect(Route('seasson.index'))->with(['success'=>'Seasson Updated Seccessfully']);
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
