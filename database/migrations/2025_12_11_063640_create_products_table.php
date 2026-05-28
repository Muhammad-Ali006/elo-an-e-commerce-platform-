<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        
        // This links the product to a category (Foreign Key)
        // If you delete a category, this deletes all products in it (cascade)
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        
        $table->string('name');         // e.g. "Blue Denim Jacket"
        $table->text('description');    // Long text for details
        $table->decimal('price', 8, 2); // 8 digits total, 2 decimals (e.g. 999999.99)
        $table->string('image')->nullable(); // We will store the filename here
        $table->integer('stock');       // Quantity available
        
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
