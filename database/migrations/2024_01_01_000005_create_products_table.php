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
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->string('product_code')->nullable();
            $table->string('key_type')->nullable();
            $table->string('material')->nullable();
            $table->string('keyboard_type')->nullable();
            $table->string('switch')->nullable();
            $table->string('backlight')->nullable();
            $table->string('battery')->nullable();
            $table->string('size')->nullable();
            $table->string('weight')->nullable();
            $table->string('compatibility')->nullable();
            $table->integer('warranty')->nullable();
            $table->string('image')->nullable(); 
            // Define the foreign key relationship
            $table->foreign('category_id')->references('id')->on('categories');
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
