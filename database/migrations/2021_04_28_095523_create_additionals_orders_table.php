<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('additional_id')->unsigned();
            $table->foreign('additional_id')->references('id')->on('additionals')->onDelete('cascade');
            $table->unsignedBigInteger('orders_id')->unsigned();
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additionals_orders');
    }
}
