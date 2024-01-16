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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
           
            $table->string('title');
            $table->string('slug');
            $table->text('short_description')->nullable();
            $table->decimal('price');
            $table->decimal('sale_price')->nullable();
            $table->longText('description')->nullable();
            $table->longText('additional_info')->nullable();
            $table->integer('status')->default(1)->comment('1==active, 0==deactive');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
