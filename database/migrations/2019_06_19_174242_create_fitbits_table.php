<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFitbitsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fitbits', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('token');
            $table->string('user_id');
            $table->string('name');
            $table->string('datebirth');
            $table->string('age');
            $table->string('continent')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('dock')->nullable();
            $table->tinyInteger('avilable')->default('0');
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
        Schema::drop('fitbits');
    }
}
