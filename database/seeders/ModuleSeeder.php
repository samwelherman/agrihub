<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SystemModule;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            ['slug' => 'manage-dashboard'],
            ['slug' => 'manage-farmer'],
             ['slug' => 'manage-farming'],
             ['slug' => 'manage-orders'],
             ['slug' => 'manage-warehouse'],
             ['slug' => 'manage-shop'],
            ['slug' => 'manage-access-control'], 
        ];
foreach ($data as $row) {
    SystemModule::updateOrCreate($row);
}
    }
}
