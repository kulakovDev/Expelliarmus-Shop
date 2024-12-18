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
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->generatedAs('START WITH 1000')->always();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->nullOnDelete();
            $table->foreignId('brand_id')->constrained()->nullOnDelete();
            $table->text('title_description');
            $table->longText('main_description_markdown');
            $table->longText('main_description_html');
            $table->json('images')->nullable();
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
