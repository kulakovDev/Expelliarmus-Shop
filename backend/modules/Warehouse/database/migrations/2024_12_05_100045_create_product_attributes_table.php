<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*Schema::create('product_attributes', function (Blueprint $table) {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });*/

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs()->always()->primary();
            $table->string('name');
            $table->string('type');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();
        });

        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs()->always()->primary();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attribute_id')->constrained('product_attributes')->cascadeOnDelete();
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
};
