<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIotDevicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iot_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ipServer');
            $table->string('fiwareService');
            $table->string('fiwarePath');
            $table->string('device_id');
            $table->string('entity_name');
            $table->string('entity_type');
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
        Schema::drop('iot_devices');
    }
}
