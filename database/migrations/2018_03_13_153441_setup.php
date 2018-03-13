<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Setup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function(Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('colour');
            $table->timestamps();
        });

        Schema::create('levels', function(Blueprint $table){
            $table->increments('id');
            $table->integer('block_id')->unsigned()->index();
            $table->integer('level_order')->unsigned()->index();
            $table->string('name');
            $table->string('colour');
            $table->string('map_path');
            $table->timestamps();
        });

        Schema::create('zones', function(Blueprint $table){
            $table->increments('id');
            $table->integer('block_id')->unsigned()->index();
            $table->integer('level_id')->unsigned()->index();
            $table->integer('zone_category_id')->unsigned()->index();
            $table->string('name');
            $table->string('name_display');
            $table->string('bg_colour');
            $table->string('text_colour');
            $table->string('text_size');
            $table->text('area_json');
            $table->timestamps();
        });

        Schema::create('areas', function(Blueprint $table){
            $table->increments('id');
            $table->integer('block_id')->unsigned()->index();
            $table->integer('level_id')->unsigned()->index();
            $table->string('name');
            $table->string('text_size');
            $table->text('area_json');
            $table->timestamps();
        });

        Schema::create('categories', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('area_categories', function(Blueprint $table){
            $table->increments('id');
            $table->integer('area_id')->index();
            $table->integer('category_id')->index();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blocks');
        Schema::drop('levels');
        Schema::drop('zones');
        Schema::drop('areas');
        Schema::drop('categories');
        Schema::drop('area_categories');

    }
}
