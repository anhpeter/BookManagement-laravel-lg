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
            $table->foreignId('user_id')->constraint();
            $table->string('address');
            $table->string('status');
            $table->string('note')->nullable();
            $table->string('phone')->nullable();
            $table->string('shipping_method')->default('fast');
            $table->string('payment_method')->default('cod');
            $table->string('total_price')->default(0);
            $table->foreignId('created_by')->nullable();
            $table->foreignId('modified_by')->nullable();
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
