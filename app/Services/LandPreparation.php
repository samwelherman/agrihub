<?php

namespace App\Services;
use App\Services\CropsLifeCycleInterface;
use App\Services\CropSowing;
use App\Models\farming\PreparationDetails;
use App\Models\farming\PreparationCostLists;
   
class LandPreparation  implements CropsLifeCycleInterface
{   
   
    public function landPreparation($data,$type,$function){
        if($function == "preparation"){
            return $this->preparation($data,$type);
        }elseif($function == "sowing"){
            return $this->cropSowing($data,$type);
        }

    }

     //preparation functions
    public function preparation($data,$type){
            if($type =="store")
            return $this->saveLandPreparation($data);
            elseif($type == "update")
            return $this->updateLandPreparation($data);
            elseif($type == "edit")
            return $this->getByIdLandPreparation($data);
    }

    private function getByIdLandPreparation($id){

        $result['preparation'] = PreparationDetails::find($id);
       $result['costs'] = PreparationCostLists::all()->where('preparation_id',$id);

       return $result;
    }

    public function saveLandPreparation($request){
        $details['preparation_type'] =  $request['preparation_type'];
        $details['soil_salt'] =  $request['soil_salt'];
        $details['acid_level'] =  $request['acid_level'];
        $details['moisture_level'] =  $request['moisture_level'];
        $details['user_id'] =  auth()->user()->id;

        $preparationDetails = PreparationDetails::create($details);

        $amountArr = str_replace(",","",$request['amount']);
        $totalArr =  str_replace(",","",$request['tax']);

        $nameArr =$request['item_name'] ;
        $qtyArr = $request['quantity'] ;
        $priceArr = $request['price'];
        $rateArr = $request['tax_rate'] ;
        
        $costArr = str_replace(",","",$request['total_cost']);
        
        $savedArr =$request['item_name'] ;
        
        $cost['preparation_cost'] = 0;
        
        if(!empty($nameArr)){
            for($i = 0; $i < count($nameArr); $i++){
                if(!empty($nameArr[$i])){
                    $cost['preparation_cost'] +=$costArr[$i];
                    

                    $items = array(
                        'item_name' => $nameArr[$i],
                        'quantity' =>   $qtyArr[$i],
                        'tax_rate' =>  $rateArr [$i],
                        
                           'price' =>  $priceArr[$i],
                        'total_cost' =>  $costArr[$i],
                        
                         'items_id' => $savedArr[$i],
                           'order_no' => $i,
                        'preparation_id' =>$preparationDetails->id);
                       
                        PreparationCostLists::create($items);  ;
    
    
                }
            }
            
            $cost['preparation_cost'] =  $cost['preparation_cost'];
            PreparationDetails::where('id',$preparationDetails->id)->update($cost);
        }    

        return true;


    } 

    public function updateLandPreparation($request){
        $details['preparation_type'] =  $request['preparation_type'];
        $details['soil_salt'] =  $request['soil_salt'];
        $details['acid_level'] =  $request['acid_level'];
        $details['moisture_level'] =  $request['moisture_level'];
        $details['user_id'] =  auth()->user()->id;



        $preparationDetails = PreparationDetails::where('id',$request['id'])->update($details);

        $amountArr = str_replace(",","",$request['amount']);
        $totalArr =  str_replace(",","",$request['tax']);

        $nameArr =$request['item_name'] ;
        $qtyArr = $request['quantity'] ;
        $priceArr = $request['price'];
        $rateArr = $request['tax_rate'] ;
        
        $costArr = str_replace(",","",$request['total_cost']);
        
        $savedArr =$request['item_name'] ;
        
        $cost['preparation_cost'] = 0;
        
        if(!empty($nameArr)){
            for($i = 0; $i < count($nameArr); $i++){
                if(!empty($nameArr[$i])){
                    $cost['preparation_cost'] +=$costArr[$i];
                    

                    $items = array(
                        'item_name' => $nameArr[$i],
                        'quantity' =>   $qtyArr[$i],
                        'tax_rate' =>  $rateArr [$i],
                        
                           'price' =>  $priceArr[$i],
                        'total_cost' =>  $costArr[$i],
                        
                         'items_id' => $savedArr[$i],
                           'order_no' => $i,
                        'preparation_id' =>$request['id']);
                       
                        PreparationCostLists::where('preparation_id',$request['id'])->update($items);  ;
    
    
                }
            }
            
            $cost['preparation_cost'] =  $cost['preparation_cost'];
            PreparationDetails::where('id',$request['id'])->update($cost);
        }    

        return true;


    } 

    //sowing functions
    public function cropSowing($data,$type){
        if($type =="store")
        return $this->saveCropSowing($data);
        elseif($type == "update")
        return $this->updateCropSowing($data);
        elseif($type == "edit")
        return $this->getByIdCropSowing($data);
       

        

    }

    private function getByIdCropSowing($id){

        $result['sowing'] = Sowing::find($id);
     

       return $result;
    }

    public function saveCropSowing($request){
        $details['crops_type'] =  $request['crops_type'];
        $details['seed_type'] =  $request['seed_type'];
        $details['qheck'] =  $request['qheck'];
        $details['cost'] =  $request['cost'];
        $details['nh'] =  $request['nh'];
        $details['qn'] =  $request['qn'];
        $details['user_id'] =  auth()->user()->id;

        $sowing = Sowing::create($details);

       
   

        return true;


    } 

    public function updateCropSowing($request){
        $details['crops_type'] =  $request['crops_type'];
        $details['seed_type'] =  $request['seed_type'];
        $details['qheck'] =  $request['qheck'];
        $details['cost'] =  $request['cost'];
        $details['nh'] =  $request['nh'];
        $details['qn'] =  $request['qn'];
        $details['user_id'] =  auth()->user()->id;

        $preparationDetails = Sowing::where('id',$request['id'])->update($details);

       
    } 
  
}