<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_accessories', function (Blueprint $table) {
            $table->id();

            $table->integer('window_id');

            $table->string('sashroll')->nullable();
            $table->integer('sashrollqty')->nullable();
            $table->integer('sashrollrate')->nullable();

            $table->string('bumperblock')->nullable();
            $table->integer('bumperblockqty')->nullable();
            $table->integer('bumperblockrate')->nullable();

            // $table->string('DTape_screws')->nullable();
            $table->string('dummywheel')->nullable();
            $table->integer('dummywheelqty')->nullable();
            $table->integer('dummywheelrate')->nullable();

            // $table->string('fiber_net')->nullable();
            $table->string('flathandle')->nullable();
            $table->integer('flathandleqty')->nullable();
            $table->integer('flathandlerate')->nullable();

            // $table->string('fly_screen_gaskit')->nullable();
            // $table->string('fly_screen_slidingwheel')->nullable();
            // $table->string('sliding_gearkeep')->nullable();
            // $table->string('sliding_gear')->nullable();
            $table->string('netwheel')->nullable();
            $table->integer('netwheelqty')->nullable();
            $table->integer('netwheelrate')->nullable();

            $table->string('stopper')->nullable();
            $table->integer('stopperqty')->nullable();
            $table->integer('stopperrate')->nullable();

            $table->string('windbreak')->nullable();
            $table->integer('windbreakqty')->nullable();
            $table->integer('windbreakrate')->nullable();

            // $table->string('concretfitscrew')->nullable();
            // $table->string('steelscrew')->nullable();
            $table->string('silicon')->nullable();
            $table->integer('siliconqty')->nullable();
            $table->integer('siliconrate')->nullable();

            $table->string('fixer')->nullable();
            $table->integer('fixerqty')->nullable();
            $table->integer('fixerrate')->nullable();

            $table->string('slidekeep')->nullable();
            $table->integer('slidekeepqty')->nullable();
            $table->integer('slidekeeprate')->nullable();
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
        Schema::dropIfExists('assign_accessories');
    }
}
