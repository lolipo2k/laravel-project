<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_service', function (Blueprint $table) {
            // $table->id();
            $table->unsignedBigInteger('additional_id')->unsigned();
            $table->foreign('additional_id')->references('id')->on('additionals')->onDelete('cascade');
            $table->unsignedBigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('additional_service', function (Blueprint $table) {
            $table->dropForeign(['additional_id']);
            $table->dropForeign(['service_id']);
        });

        Schema::dropIfExists('additional_service');
    }
}
