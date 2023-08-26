<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSlidingAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sliding_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('aluminium_rail')->nullable();
            $table->string('brush_rolls')->nullable();
            $table->string('bumpler_block')->nullable();
            $table->string('DTape_screws')->nullable();
            $table->string('dummy_wheels')->nullable();
            $table->string('fiber_net')->nullable();
            $table->string('flat_handle')->nullable();
            $table->string('fly_screen_gaskit')->nullable();
            $table->string('fly_screen_slidingwheel')->nullable();
            $table->string('gear_handles')->nullable();
            $table->string('sliding_gearkeep')->nullable();
            $table->string('sliding_gear')->nullable();
            $table->string('sliding_gearwheels')->nullable();
            $table->string('stoppers')->nullable();
            $table->string('wind_break')->nullable();
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
        Schema::dropIfExists('user_sliding_accesses');
    }
}
