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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs()->always();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('product_article')->unique();
            $table->integer('total_quantity');
            $table->decimal('price_per_unit_in_cents')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse');
    }
};
