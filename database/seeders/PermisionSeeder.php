<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
       
       
     
         
        $data = [
            #1. manage-dashboard permissions
            ['slug' => 'view-dashboard','sys_module_id'=>1],
            ['slug' => 'edit-dashboard','sys_module_id'=>1],
            ['slug' => 'delete-dashboard','sys_module_id'=>1],
            ['slug' => 'add-dashboard','sys_module_id'=>1],
           

            // end manage-User permissions

            #2.start manage-farmer permissions
            ['slug' => 'view-farmer','sys_module_id'=>2],
            ['slug' => 'edit-farmer','sys_module_id'=>2],
            ['slug' => 'delete-farmer','sys_module_id'=>2],
            ['slug' => 'add-farmer','sys_module_id'=>2],
            ['slug' => 'confirm-farmer','sys_module_id'=>2],

            ['slug' => 'view-group','sys_module_id'=>2],
            ['slug' => 'edit-group','sys_module_id'=>2],
            ['slug' => 'delete-group','sys_module_id'=>2],
            ['slug' => 'add-group','sys_module_id'=>2],
            ['slug' => 'confirm-group','sys_module_id'=>2],
            // end manage-farmer permissions

            #3.start manage-farming permissions
            ['slug' => 'view-farmer-assets','sys_module_id'=>3],
            ['slug' => 'edit-farmer-assets','sys_module_id'=>3],
            ['slug' => 'delete-farmer-assets','sys_module_id'=>3],
            ['slug' => 'add-farmer-assets','sys_module_id'=>3],

            ['slug' => 'view-farming-cost','sys_module_id'=>3],
            ['slug' => 'edit-farming-cost','sys_module_id'=>3],
            ['slug' => 'delete-farming-cost','sys_module_id'=>3],
            ['slug' => 'add-farming-cost','sys_module_id'=>3],

            ['slug' => 'view-cost-centre','sys_module_id'=>3],
            ['slug' => 'edit-cost-centre','sys_module_id'=>3],
            ['slug' => 'delete-cost-centre','sys_module_id'=>3],
            ['slug' => 'add-cost-centre','sys_module_id'=>3],

            ['slug' => 'view-farming-process','sys_module_id'=>3],
            ['slug' => 'edit-farming-process','sys_module_id'=>3],
            ['slug' => 'delete-farming-process','sys_module_id'=>3],
            ['slug' => 'add-farming-process','sys_module_id'=>3],

            ['slug' => 'view-crop-monitoring','sys_module_id'=>3],
            ['slug' => 'edit-crop-monitoring','sys_module_id'=>3],
            ['slug' => 'delete-crop-monitoring','sys_module_id'=>3],
            ['slug' => 'add-crop-monitoring','sys_module_id'=>3],

            ['slug' => 'view-manage_seasson','sys_module_id'=>3],
            ['slug' => 'edit-manage_seasson','sys_module_id'=>3],
            ['slug' => 'delete-manage_seasson','sys_module_id'=>3],
            ['slug' => 'add-manage_seasson','sys_module_id'=>3],
            
            // end manage-request permissions

          #2.start manage-orders permissions
          ['slug' => 'view-order_list','sys_module_id'=>4],
          ['slug' => 'edit-order_list','sys_module_id'=>4],
          ['slug' => 'delete-order_list','sys_module_id'=>4],
          ['slug' => 'add-order_list','sys_module_id'=>4],

          ['slug' => 'view-quotation-list','sys_module_id'=>4],
          ['slug' => 'edit-quotation-list','sys_module_id'=>4],
          ['slug' => 'delete-quotation-list','sys_module_id'=>4],
          ['slug' => 'add-quotation-list','sys_module_id'=>4],
          
          // end manage-request permissions
        
          #2.start manage-warehouse permissions
          ['slug' => 'view-warehouse','sys_module_id'=>5],
          ['slug' => 'edit-warehouse','sys_module_id'=>5],
          ['slug' => 'delete-warehouse','sys_module_id'=>5],
          ['slug' => 'add-warehouse','sys_module_id'=>5],
          
          // end manage-request permissions

              #2.start manage-shop permissions
              ['slug' => 'view-supplier','sys_module_id'=>6],
              ['slug' => 'edit-supplier','sys_module_id'=>6],
              ['slug' => 'delete-supplier','sys_module_id'=>6],
              ['slug' => 'add-supplier','sys_module_id'=>6],

              ['slug' => 'view-product','sys_module_id'=>6],
              ['slug' => 'edit-product','sys_module_id'=>6],
              ['slug' => 'delete-product','sys_module_id'=>6],
              ['slug' => 'add-product','sys_module_id'=>6],

              ['slug' => 'view-purchase','sys_module_id'=>6],
              ['slug' => 'edit-purchase','sys_module_id'=>6],
              ['slug' => 'delete-purchase','sys_module_id'=>6],
              ['slug' => 'add-purchase','sys_module_id'=>6],

              ['slug' => 'view-sales','sys_module_id'=>6],
              ['slug' => 'edit-sales','sys_module_id'=>6],
              ['slug' => 'delete-sales','sys_module_id'=>6],
              ['slug' => 'add-sales','sys_module_id'=>6],
              
             
              // end manage-request permissions

       

            

           

            #3.start manage-AccessControl permissions  
            ['slug' => 'view-roles','sys_module_id'=>7],
            ['slug' => 'add-roles','sys_module_id'=>7],
            ['slug' => 'edit-roles','sys_module_id'=>7],
            ['slug' => 'delete-roles','sys_module_id'=>7],

            ['slug' => 'view-permission','sys_module_id'=>7],
            ['slug' => 'add-permission','sys_module_id'=>7],
            ['slug' => 'edit-permission','sys_module_id'=>7],
            ['slug' => 'delete-permission','sys_module_id'=>7],

            ['slug' => 'view-user','sys_module_id'=>7],
            ['slug' => 'add-user','sys_module_id'=>7],
            ['slug' => 'edit-user','sys_module_id'=>7],
            ['slug' => 'delete-user','sys_module_id'=>7],

            ['slug' => 'view-dashboard','sys_module_id'=>7],
            

            

             // end manage-AccessControl permissions 
            

            
       ];

         foreach ($data as $row) {
            Permission::firstOrCreate($row);
         }
    }
}
