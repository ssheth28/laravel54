<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('desk_name');
            $table->string('ip_address');
            $table->string('keyboard_name');
            $table->string('mouse_name');
            $table->string('manufacture_name');
            $table->string('asset_price');
            $table->string('motherboard_model');
            $table->string('processor');
            $table->string('hdd');
            $table->string('os_version');
            $table->string('description');
             $table->softDeletes();
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
        Schema::dropIfExists('assets');
    }
}
