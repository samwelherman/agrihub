<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_movements', function (Blueprint $table) {
            $table->id();
            $table->integer('transport_id');
            $table->integer('quantity');
            $table->string('start_location');
            $table->string('end_location');
            $table->integer('client_id');
            $table->integer('warehouse_id');
            $table->integer('amount');
            $table->decimal('due_amount');
            $table->integer('tax');
            $table->integer('status');
            $table->string('truck')->nullable();
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
        Schema::dropIfExists('order_movements');
    }
}
