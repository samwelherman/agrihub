<?php

namespace App\Http\Controllers\farming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CropsLifeCycleInterface;
use App\Models\farming\Preparation_cost;
use App\Models\farming\PreparationDetails;
use App\Models\farming\Sowing;
use App\Models\farming\Pestiside;
use App\Models\farming\Fertilizer; 
use App\Models\farming\PreHarvest; 
use App\Models\farming\PostHarvest; 

use Session;

class CropsLifeCycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $type = Session::get('success');
        $seasson_id = Session::get('seasson_id');
         if(empty($type))
         $type = "preparation";

        $name = Preparation_cost::all();
        $preparationDetails = PreparationDetails::all();
        $sowing = Sowing::all();
        $fertilizer = Fertilizer::all();
        $pestiside = Pestiside::all();
        $pre_harvest = PreHarvest::all();

        $post_harvest = PostHarvest::all();
        return view('farming_process.crop_life_cycle',compact('name','seasson_id','preparationDetails','type','sowing','fertilizer','pestiside','pre_harvest','post_harvest'));
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
    public function store(Request $request,CropsLifeCycleInterface $cropsLifeCycleInterface)
    {
        //
        $function = $request->type;
        
        $result =   $cropsLifeCycleInterface->landPreparation($request->all(),"store",$function);

        if($result){
            return redirect()->route('cropslifecycle.index', $function)->with(['success'=>$function,'seasson_id'=>$request->seasson_id]);
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
    public function edit($id,Request $request)
    {
        //
//
    }
    public function editLifeCycle(Request $request,CropsLifeCycleInterface $cropsLifeCycleInterface){
        $function = $request->type;
        
            $result =   $cropsLifeCycleInterface->landPreparation($request->id,"edit",$function);
            if(!empty($result)){
                $name = Preparation_cost::all();
                $id = $request->id;
                $data = $result['result'];
                $costs = $result['costs'];
                $type = "edit-".$function;
                $seasson_id = $request->seasson_id;
                
                return view('farming_process.crop_life_cycle',compact('name','id','seasson_id','data','costs','type'));
            }else{
                echo  "jau"; 
            }
        
    }

    public function deleteLifeCycle(Request $request,CropsLifeCycleInterface $cropsLifeCycleInterface){
        $function = $request->type;
        
        $result =   $cropsLifeCycleInterface->landPreparation($request->id,"delete",$function);
        if($result){
            return redirect()->route('cropslifecycle.index', $function)->with(['success'=>$function,'seasson_id'=>$request->seasson_id]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,CropsLifeCycleInterface $cropsLifeCycleInterface)
    {
        //
        $function = $request->type;
        $data = $request->all();
        $data['id'] = $id;
             
        $result =   $cropsLifeCycleInterface->landPreparation($data,"update",$function);
        if($result){
             return redirect()->route('cropslifecycle.index', ['type' => $function,'id'=>$id])->with(['success'=>$function]);
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
