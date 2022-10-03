<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('menu_title');
            $table->boolean('top_index');
            $table->float('price');
            $table->float('minutes')->default(0);

            // Окна
            $table->boolean('window')->default(false);
            $table->integer('window_min')->default(false);
            $table->float('window_time')->default(0.5);
            $table->integer('window_price')->nullable()->default(0);

            // Хата
            $table->boolean('apartment')->default(false);
            $table->integer('rooms_price')->nullable();
            $table->float('rooms_time')->default(0.5);
            $table->integer('bathrooms_price')->nullable();
            $table->float('bathrooms_time')->default(0.5);
            $table->float('private_house')->nullable();

            // После ремонта
            $table->boolean('repairs')->default(0);
            $table->integer('repair_price')->default(0); // price for m2
            $table->float('repair_time')->default(0.5);
            $table->integer('repair_window_price')->nullable()->default(0);
            $table->float('repair_window_time')->nullable()->default(0.5);
            $table->float('repair_stairs_price')->nullable();

            $table->string('cover')->nullable();
            $table->longText('menu_icon')->nullable();
            $table->integer('position')->default(0);
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
        Schema::dropIfExists('services');
    }
}
