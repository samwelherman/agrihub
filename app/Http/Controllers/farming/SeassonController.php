<?php

namespace App\Http\Controllers\farming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\farming\Seasson;
use App\Models\farming\Preparation_cost;
use App\Models\farming\PreparationDetails;
use App\Models\farming\Sowing;
use App\Models\farming\Fertilizer;

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
        $seasson_id = $id;
        //
        $name = Preparation_cost::all();

        $preparationDetails = PreparationDetails::all();
        $name = Preparation_cost::all();
        $type = "preparation";
        $sowing = Sowing::all();
        $fertilizer = Fertilizer::all();
        return view('farming_process.crop_life_cycle',compact('name','seasson_id','preparationDetails','type','sowing'));

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
