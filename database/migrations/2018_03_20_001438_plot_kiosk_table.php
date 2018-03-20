<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlotKioskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kiosk_locations', function(Blueprint $table){
            $table->increments('id');
            $table->string('slug')->index();
            $table->integer('level_id')->unsigned()->index();
            $table->text('position_json')->nullable();

            // 0 : SOUTH
            // 1 : NORTH
            $table->integer('direction')->default(1);
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
        Schema::drop('kiosk_locations');
    }
}
