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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id');
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->integer('status')->default(1)->comment('1==active, 0==deactive');
            $table->string('description')->nullable();
            $table->SoftDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

// $table->increments('id');
// $table->integer('category_id')->unsigned()->index();
// $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
// $table->string('name');
// $table->string('slug');
// $table->string('category');
// $table->string('description');
// $table->string('releaseDate');
// $table->float('price');
