<?php

namespace App\Http\Controllers\farming;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CropsLifeCycleInterface;
use App\Models\farming\Preparation_cost;
use App\Models\farming\PreparationDetails;

class CropsLifeCycleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=null,$id=null)
    {
        $name = Preparation_cost::all();

        $preparationDetails = PreparationDetails::all();
        $type = "view-preparation";
        
        return view('farming_process.crop_life_cycle',compact('name','id','preparationDetails','type'));
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
            return redirect()->route('cropslifecycle.index', ['type' => $function])->with(['success'=>$function]);
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
        if($request->type == "preparation"){
            $result =   $cropsLifeCycleInterface->landPreparation($id,"edit");
            if(!empty($result)){
                $name = Preparation_cost::all();

                $data = $result['preparation'];
                $costs = $result['costs'];
                $type = "edit-preparation";
                
                return view('farming_process.crop_life_cycle',compact('name','id','data','çosts','type'));
            }
         }else{
             echo  "holaa";
         }
    }
    public function editLifeCycle(Request $request,CropsLifeCycleInterface $cropsLifeCycleInterface){
       
        if($request->type == "preparation"){
            $result =   $cropsLifeCycleInterface->landPreparation($request->id,"edit");
            if(!empty($result)){
                $name = Preparation_cost::all();
                $id = $request->id;
                $data = $result['preparation'];
                $costs = $result['costs'];
                $type = "edit-preparation";
                
                return view('farming_process.crop_life_cycle',compact('name','id','data','costs','type'));
            }else{
                echo  "jau"; 
            }
         }else{
             echo  "holaa";
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
        $data = $request->all();
        $data['id'] = $id;
             
        if($request->type == "preparation"){
            $result =   $cropsLifeCycleInterface->landPreparation($data,"update");
            if($result){
             return redirect()->route('cropslifecycle.index', ['type' => 'land_preparation','id'=>$id])->with(['success'=>"Land Preparation Update added Successfully"]);
            }
         }else{
             echo  "holaa";
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
