<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_transport_quotations', function (Blueprint $table) {
            $table->id();
            $table->date('crop_type');
            $table->integer('quantity');
            $table->integer('from');
            $table->integer('to');
            $table->integer('client_id');
            $table->integer('warehouse_id');
            $table->integer('amount');
            $table->integer('status');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD:database/migrations/2022_02_14_112453_create_orders_table.php.orig
        Schema::dropIfExists('tbl_orders');
||||||| merged common ancestors:database/migrations/2022_02_14_112453_create_orders_table.php.orig
        Schema::dropIfExists('orders');
=======
        Schema::dropIfExists('tbl_transport_quotations');
>>>>>>> f8b114697c84e5d7aa962df3d0235cf60bb1376f:database/migrations/2022_02_28_145220_create_transport_quotations_table.php
    }
}
