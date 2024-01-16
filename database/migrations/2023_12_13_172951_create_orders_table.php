<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            
            $table->string('transaction_id');
            $table->bigInteger('coupon_id')->nullable();
          
            $table->decimal('coupon_discount')->nullable();
            $table->decimal('shipping_charge')->nullable();
           
            $table->decimal('price');
            $table->decimal('add_price')->nullable();
            $table->string('note')->nullable();
            $table->string('order_status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->decimal('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
