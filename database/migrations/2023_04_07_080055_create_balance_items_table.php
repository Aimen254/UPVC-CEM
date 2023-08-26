<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_items', function (Blueprint $table) {
            $table->id();
            $table->integer('balance')->default(0);
            $table->integer('account')->default(0);
            $table->string('account_name')->nullable();
            $table->string('revenue')->nullable();
            $table->string('expense')->nullable();
            $table->string('discription')->nullable();
            $table->string('totalbalance')->nullable();
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
        Schema::dropIfExists('balance_items');
    }
}
