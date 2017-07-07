<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->integer('country_id');
            $table->timestamp('dob')->nullable();
            $table->string('contact_no');
            $table->string('skype_address')->nullable();
            $table->string('company_email');
            $table->string('client_residence_address');
            $table->string('client_company_name');
            $table->string('website');
            $table->string('industry');
            $table->string('client_company_address');
            $table->string('other_details')->nullable();
            $table->string('fb_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('twitter_id')->nullable();
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
        Schema::drop('clients');
    }
}
