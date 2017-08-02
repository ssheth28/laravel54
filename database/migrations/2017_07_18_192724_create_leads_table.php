<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lead_name');
            $table->string('email');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('contact_no');
            $table->string('skype_id')->nullable();
            $table->string('reference')->nullable();
            $table->string('last_update_status')->nullable();
            $table->integer('poc_id')->unsigned()->nullable();
            $table->foreign('poc_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->string('industry')->nullable();
            $table->string('other_detail')->nullable();
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
        Schema::drop('leads');
    }
}
