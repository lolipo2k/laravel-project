<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('address_id')->nullable();
            $table->integer('service_id');
            $table->integer('sub_id')->default(0);
            $table->integer('keys')->nullable();
            $table->float('cost');

            // Хата
            $table->integer('rooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->boolean('private_house')->default(0);
            $table->boolean('kitchen')->nullable();

            // Окна
            $table->integer('window_count')->nullable();

            // Ремонт
            $table->integer('repair_m2')->default(0);
            $table->integer('repair_window')->nullable()->default(0);
            $table->float('repair_stairs')->nullable();

            /*
             * 0 - Создан
             * 1 - Оформлен
             */
            $table->integer('status');

            /*
             * 0 - Наличными
             * > 0 - ID Оплаты
            */
            $table->integer('pay')->nullable();
            $table->text('information')->nullable();
            $table->timestamp('cleaning_date');
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
        Schema::dropIfExists('orders');
    }
}
