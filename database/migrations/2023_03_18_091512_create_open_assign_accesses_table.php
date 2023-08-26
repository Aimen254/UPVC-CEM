<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenAssignAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_assign_accesses', function (Blueprint $table) {
            $table->id();
            $table->integer('window_id');

            $table->string('outwardcase')->nullable();
            $table->integer('outwardcaseqty')->nullable();
            $table->integer('outwardcaserate')->nullable();

            $table->string('windowstay')->nullable();
            $table->integer('windowstayqty')->nullable();
            $table->integer('windowstayrate')->nullable();

            $table->string('frictionstay')->nullable();
            $table->integer('frictionstayqty')->nullable();
            $table->integer('frictionstayrate')->nullable();

            $table->string('pencilhindge')->nullable();
            $table->integer('pencilhindgeqty')->nullable();
            $table->integer('pencilhindgerate')->nullable();

            $table->string('flathandle')->nullable();
            $table->integer('flathandleqty')->nullable();
            $table->integer('flathandlerate')->nullable();

            $table->string('2Dhindges')->nullable();
            $table->integer('2Dhindgesqty')->nullable();
            $table->integer('2Dhindgesrate')->nullable();

            $table->string('thDhindges')->nullable();
            $table->integer('thDhindgesqty')->nullable();
            $table->integer('thDhindgesrate')->nullable();

            $table->string('openablekeep')->nullable();
            $table->integer('openablekeepqty')->nullable();
            $table->integer('openablekeeprate')->nullable();

            $table->string('Tlock')->nullable();
            $table->integer('Tlockqty')->nullable();
            $table->integer('Tlockrate')->nullable();

            $table->string('cockspur')->nullable();
            $table->integer('cockspurqty')->nullable();
            $table->integer('cockspurrate')->nullable();

            
            $table->string('silicon')->nullable();
            $table->integer('siliconqty')->nullable();
            $table->integer('siliconrate')->nullable();
            
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
        Schema::dropIfExists('open_assign_accesses');
    }
}
