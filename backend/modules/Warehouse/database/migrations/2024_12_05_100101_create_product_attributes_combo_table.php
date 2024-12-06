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
        Schema::create('product_attributes_combo', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs()->always();
            $table->foreignId('attribute_1_id')->nullable()->constrained('product_attributes')->nullOnDelete();
            $table->foreignId('attribute_2_id')->nullable()->constrained('product_attributes')->nullOnDelete();
            $table->foreignId('attribute_3_id')->nullable()->constrained('product_attributes')->nullOnDelete();
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity')->nullable();
            $table->decimal('price_in_cents')->nullable();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes_combo');
    }
};
