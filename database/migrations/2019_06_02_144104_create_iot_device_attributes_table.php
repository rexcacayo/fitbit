<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIotDeviceAttributesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iot_device_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->integer('deviceAttr_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('deviceAttr_id')->references('id')->on('iot_devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('iot_device_attributes');
    }
}
