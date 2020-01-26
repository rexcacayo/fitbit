<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIotServicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iot_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ipServer');
            $table->string('fiwareService');
            $table->string('fiwarePath');
            $table->string('apikey');
            $table->string('cbroker');
            $table->string('entity_type');
            $table->string('resource');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iot_services');
    }
}
