<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotifiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ipServer');
            $table->string('fiwareService');
            $table->string('fiwarePath');
            $table->string('type')->nullable();
            $table->string('description');
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
        Schema::drop('notifies');
    }
}
