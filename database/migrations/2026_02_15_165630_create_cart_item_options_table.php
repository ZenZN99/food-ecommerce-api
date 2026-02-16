<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_item_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cart_item_id')->constrained('cart_items')->cascadeOnDelete();

            $table->foreignId('product_option_id')->constrained('product_options')->cascadeOnDelete();

            // price of option at time of adding to cart
            $table->decimal('price_snapshot', 10, 2);

            $table->timestamps();

            // prevent duplicate same option on same cart item
            $table->unique(['cart_item_id', 'product_option_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_item_options');
    }
};
