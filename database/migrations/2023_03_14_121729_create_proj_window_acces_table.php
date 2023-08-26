<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjWindowAccesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proj_window_acces', function (Blueprint $table) {
            $table->id();

            $table->integer('projwin_id');

            $table->integer('sashrollrate')->nullable();

            $table->integer('bumperblockrate')->nullable();

            $table->integer('dummywheelrate')->nullable();

            $table->integer('flathandlerate')->nullable();
      
            $table->integer('netwheelrate')->nullable();

            $table->integer('stopperrate')->nullable();

            $table->integer('windbreakrate')->nullable();

            $table->integer('siliconrate')->nullable();

            $table->integer('fixerrate')->nullable();

            $table->integer('slidekeeprate')->nullable();
            $table->integer('total')->nullable();

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
        Schema::dropIfExists('proj_window_acces');
    }
}
