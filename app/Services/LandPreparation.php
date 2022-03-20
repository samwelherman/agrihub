<?php

namespace App\Services;
use App\Services\CropsLifeCycleInterface;
use App\Services\CropSowing;
use App\Models\farming\PreparationDetails;
use App\Models\farming\Sowing;
use App\Models\farming\Fertilizer;
use App\Models\farming\PreparationCostLists;
   
class LandPreparation  implements CropsLifeCycleInterface
{   
   
    public function landPreparation($data,$type,$function){
        if($function == "preparation"){
            return $this->preparation($data,$type);
        }elseif($function == "sowing"){
            return $this->cropSowing($data,$type);
        }elseif($function == "fertilizer"){
            return $this->fertilizer($data,$type);
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
            elseif($type == "delete")
            return $this->deleteLandPreparation($data);
    }

    private function getByIdLandPreparation($id){

        $result['result'] = PreparationDetails::find($id);
       $result['costs'] = PreparationCostLists::all()->where('preparation_id',$id);

       return $result;
    }

    public function saveLandPreparation($request){
        $details['preparation_type'] =  $request['preparation_type'];
        $details['seasson_id'] =  $request['seasson_id'];
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
        $details['seasson_id'] =  $request['seasson_id'];
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
    public function deleteLandPreparation($id){
        $result = PreparationDetails::find($id)->delete();
        PreparationCostLists::where('preparation_id',$id)->delete();

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
        elseif($type == "delete")
        return $this->deleteCropSowing($data);
       

        

    }

    private function getByIdCropSowing($id){

        $result['result'] = Sowing::find($id);
        $result['costs'] = null;
     

       return $result;
    }

    public function saveCropSowing($request){
        $details['crop_type'] =  $request['crop_type'];
        $details['seasson_id'] =  $request['seasson_id'];
        $details['seed_type'] =  $request['seed_type'];
        $details['qheck'] =  $request['qheck'];
        $details['harvest_date'] =  $request['harvest_date'];
        $details['cost'] =  $request['cost'];
        $details['nh'] =  $request['nh'];
        $details['qn'] =  $request['qheck']*$request['nh'];
        $details['user_id'] =  auth()->user()->added_by;

        $sowing = Sowing::create($details);

       
   

        return true;


    } 

    public function updateCropSowing($request){
        $details['crop_type'] =  $request['crop_type'];
        $details['seasson_id'] =  $request['seasson_id'];
        $details['seed_type'] =  $request['seed_type'];
        $details['qheck'] =  $request['qheck'];
        $details['cost'] =  $request['cost'];
        $details['nh'] =  $request['nh'];
        $details['qn'] =  $request['qheck']*$request['nh'];
        $details['user_id'] =  auth()->user()->added_by;

        $preparationDetails = Sowing::where('id',$request['id'])->update($details);

        return true;
       
    } 
    private function deleteCropSowing($id){

        $result = Sowing::find($id)->delete();
       return true;
    }

        //fertilizers functions
        public function fertilizer($data,$type){
            if($type =="store")
            return $this->saveFertilizer($data);
            elseif($type == "update")
            return $this->updateFertilizer($data);
            elseif($type == "edit")
            return $this->getByIdFertilizer($data);
            elseif($type == "delete")
            return $this->deleteFertilizer($data);
           
    
            
    
        }
    
        private function getByIdFertilizer($id){
    
            $result['result'] = Fertilizer::find($id);
            $result['costs'] = null;
         
    
           return $result;
        }
        
        public function saveFertilizer($request){
            $details['package'] =  $request['package'];
            $details['farming_process'] =  $request['farming_process'];
            $details['fertilizer_amount'] =  $request['fertilizer_amount'];
            $details['total_amount'] =  $request['fertilizer_amount']*2;
            $details['fertilizer_price'] =  $request['fertilizer_price'];
            $details['fertilizer_cost'] =  $request['fertilizer_price']*$details['total_amount'];
            $details['user_id'] =  auth()->user()->added_by;
    
            $sowing = Fertilizer::create($details);
    
           
       
    
            return true;
    
    
        } 
    
        public function updateFertilizer($request){
            $details['package'] =  $request['package'];
            $details['farming_process'] =  $request['farming_process'];
            $details['fertilizer_amount'] =  $request['fertilizer_amount'];
            $details['total_amount'] =  $request['total_amount'];
            $details['fertilizer_price'] =  $request['fertilizer_price'];
            $details['fertilizer_cost'] =  $request['fertilizer_price']*$details['total_amount'];
            $details['user_id'] =  auth()->user()->added_by;
    
            $preparationDetails = Fertilizer::where('id',$request['id'])->update($details);
    
            return true;
           
        } 
        private function deleteFertilizer($id){
    
            $result = Fertilizer::find($id)->delete();
           return true;
        }
}