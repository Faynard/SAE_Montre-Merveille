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
        Schema::create('quantity_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Cart::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\Order::class)->nullable()->constrained();
            $table->integer('quantity');
            $table->foreignIdFor(\App\Models\Product::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quantity_items');
    }
};
