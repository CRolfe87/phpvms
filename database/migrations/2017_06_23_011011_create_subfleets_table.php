<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubfleetsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subfleets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('airline_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('type');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subfleet_rank', function(Blueprint $table) {
            $table->integer('rank_id')->unsigned();
            $table->integer('subfleet_id')->unsigned();
            $table->double('acars_pay', 19, 2)->unsigned()->nullable();
            $table->double('manual_pay', 19, 2)->unsigned()->nullable();

            $table->primary(['rank_id', 'subfleet_id']);
            $table->index(['subfleet_id', 'rank_id']);
        });

        Schema::create('subfleet_flight', function(Blueprint $table) {
            $table->integer('subfleet_id')->unsigned();
            $table->integer('flight_id')->unsigned();

            $table->primary(['subfleet_id', 'flight_id']);
            $table->index(['flight_id', 'subfleet_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subfleets');
        Schema::drop('subfleet_rank');
        Schema::drop('subfleet_flight');
    }
}