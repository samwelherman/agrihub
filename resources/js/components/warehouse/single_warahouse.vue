<template>
    <div>
       <div class="card">
            <div class="card-header">
              <!-- <h4>{{$warehouse->warehouse_name}}</h4> -->
            </div>
            <div class="padding-20">
              <ul class="nav nav-tabs" id="myTab2" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                    aria-selected="true">Famer Accounts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#deposity" role="tab"
                    aria-selected="false">Deposite History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="farm land" data-toggle="tab" href="#withdraw" role="tab"
                      aria-selected="false">Withdraw History</a>
                  </li>
              </ul>
              
              <div class="tab-content tab-bordered" id="myTab3Content">
                
                
                <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                  <h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Add New Account <i class="fa fa-plus"></i></button></h4>
                 <div class="table-responsive">
                      <!-- @if(count($accounts)>0)
                            <table class="table table-striped table-md">
                              <tbody><tr>
                          
                                <th>Account Name</th>
                                <th>Famer Name</th>
                                <th>Crops Type</th>
                                <th>Total Quantity</th>
                                <th>Action</th>
                              </tr>
                              
                              @foreach($accounts as $account)
                                 
                                 
                                 <tr>
                                   <td> {{$account->farmer->firstname}}{{$account->farmer->lastname}}_{{$account->crops_type->crop_name}}</td>
                                   <td>{{$account->farmer->firstname}} {{$account->farmer->lastname}}</td>
                                <td>{{$account->crops_type->crop_name}}</td>
                                <td>{{$account->total_quantity}}kg</td>
                                <td>
                                  <div class="row">
                                  
                                  
                               
                                  
                                  
                                    <div class="col-lg-12 col-sm-12 col-md-12">
                                  <a class="btn btn-primary"  data-toggle="modal" onclick="model('deposity',{{$account->id}},{{$warehouse->id}})"  data-target="#appFormModal" href="#" >deposite <i class="fas fa-plus"></i></a>
                                  <a  class="btn btn-primary"  data-toggle="modal" onclick="model('withdraw',{{$account->id}},{{$warehouse->id}})" data-target="#appFormModal" href="#">withdraw <i class="fas fa-minus"></i></a>
                                  
                                  
                                    </div>
                                </td>
                                 </tr>
                              @endforeach

                            </tbody>
                            <div class="card-footer text-right">
                              <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                  <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                  </li>
                                  <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                  </li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                  </li>
                                </ul>
                              </nav>
                               </div> 
                           
                            
                          </table>
                             @else
                              No data available
                           
                               @endif -->
                      
                          </div>
                  </div>
                
                <div class="tab-pane fade" id="deposity" role="tabpanel" aria-labelledby="profile-tab2">
                    <div class="table-responsive">
                      <!-- @if(count($deposity)>0)
                            <table class="table table-striped table-md">
                              <tbody><tr>
                          
                                <th>Famer Account</th>
                                <th>Crops Type</th>
                                <th>Date</th>
                                <th>Quantity</th>
                                <th>Price</th>
                              </tr>
                              @foreach($deposity as $deposity)
                                 <tr>
                                   <td>{{$deposity->farmer_account->farmer->firstname}}{{$deposity->farmer_account->farmer->lastname}}_{{$deposity->farmer_account->crops_type->crop_name}}</td>
                                <td>{{$deposity->farmer_account->crops_type->crop_name}}</td>
                                <td>{{$deposity->created_at}}</td>
                                <td> {{$deposity->quantity}}kg</td>
                                <td>{{$deposity->cost}}</td>
                                 </tr>
                              @endforeach

                            </tbody>
                            <div class="card-footer text-right">
                              <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                  <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                  </li>
                                  <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                  </li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                  </li>
                                </ul>
                              </nav>
                                 </div> 
                             
                            
                          </table>
                           @else
                              No data available
                         
                               @endif -->
                      
                          </div>
                </div>
                
                
                   <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="profile-tab2">
                    <div class="table-responsive">
                      <!-- @if(count($withdraw)>0)
                            <table class="table table-striped table-md">
                              <tbody><tr>
                          
                                <th>Famer Account</th>
                                <th>Crops Type</th>
                                <th>Date</th>
                                <th>Quantity</th>
                              </tr>
                              
                              @foreach($withdraw as $withdraw)
                                 <tr>
                                <td>{{$withdraw->farmer_account->farmer->firstname}}{{$deposity->farmer_account->farmer->lastname}}_{{$deposity->farmer_account->crops_type->crop_name}}</td>
                                <td>{{$withdraw->farmer_account->crops_type->crop_name}}</td>
                                <td>{{$withdraw->created_at}}</td>
                                <td> {{$withdraw->quantity}}kg</td>
                                
                                 </tr>
                              @endforeach

                            </tbody>
                            <div class="card-footer text-right">
                              <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                  <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                  </li>
                                  <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                  </li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                  </li>
                                </ul>
                              </nav>
                               </div> 
                            
                            
                          </table>
                            @else
                              No data available
                           
                               @endif
                       -->
                          </div>
                </div>
                
                
              </div>
            </div>
          </div>
    </div>
</template>

<script>
import { reactive,onMounted,computed} from "vue";
import axios from 'axios'
export default {
   setup() {
    // data used in state of component
    const state = reactive({
        dialog_state: false,
        region_id:'',
        page_data:{districts:[]},
        districts_data:[],
        filtered_district: computed(() => {
              return state.page_data.districts.filter(
                      district => Number(district.region_id)===Number(warehouse_form_data.region_id)
                      )}),
        
    })
    // data to handel response
    const  response_data= reactive({
      message:'',
      successful:false,
      error:false,
      });
    // data used on register warehouse
    const warehouse_form_data = reactive({
        warehousename:'',
        added_by:'',
        region_id:'',
        district_id:'',
        insurence:'',
        managercontact:'',
        warehousemanager:'',
    });
    // fuction called on component mounted
     onMounted(() => {
       getdata()
      console.log("component mounted");
    });

    // function of gate page data
     const  getdata = async() => {
       await axios.get('warehouse_backend').then(
           response=>{
               console.log(response.data);
               state.page_data=response.data
               }).catch(error =>{  console.log(error)})
    };

    const  register_warehouse = async() => {
      warehouse_form_data.added_by=state.page_data.user_id
      console.log(warehouse_form_data)
       await axios.post("warehouse_backend",warehouse_form_data).then(
         response=>{
           if(response.status==200){
            response_data.message = response.data.message;
             response_data.error=false;
            response_data.successful=true;
            warehouse_form_data.warehousename='';
            warehouse_form_data.added_by='';
            warehouse_form_data.region_id='';
            warehouse_form_data.district_id='';
            warehouse_form_data.insurence='';
            warehouse_form_data.managercontact='';
            warehouse_form_data.warehousemanager='';
            //  state.dialog_state = false,
            //  document.getElementById("close").click()
            // console.log(response.data)
             }else{
            response_data.message = response.data.message;
            response_data.successful=false;
            response_data.error=true;
             }}).catch(error =>{  response_data.message = "sorry fill all data";
             response_data.successful=false;
            response_data.error=true})
    };


    return { state,warehouse_form_data,response_data,getdata,register_warehouse };
  },
       
     
       
       
    }
</script>
