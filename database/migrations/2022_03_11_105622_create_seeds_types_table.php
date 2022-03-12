<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\farming\Seeds_type;

class CreateSeedsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('tbl_seed_types', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->integer('crop_type_id');
        //     $table->integer('status');
        //     $table->integer('added_by');
        //     $table->timestamps();
        // });

        Seeds_type::create(
            [
                'name' => 'tanzaniasq',
                'crop_type_id' => '1',
                'status' => '1',
                'added_by' => '1',
            ],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('tbl_seed_types');
    // }
}
