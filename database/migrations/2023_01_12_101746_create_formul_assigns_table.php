<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formul_assigns', function (Blueprint $table) {
            $table->id();
            $table->integer('image_id')->default('0');
            $table->integer('formula_id')->default('0');
            $table->integer('acess_id')->default('0');
            $table->string('formula_type');
            $table->string('imagename');
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
        Schema::dropIfExists('formul_assigns');
    }
}
