<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Products: stock is queried in admin dashboard (low stock alert)
        Schema::table('products', function (Blueprint $table) {
            $table->index('stock', 'idx_products_stock');
        });

        // Products: created_at is used for ORDER BY on every product listing
        Schema::table('products', function (Blueprint $table) {
            $table->index('created_at', 'idx_products_created_at');
        });

        // Products: FULLTEXT index for product search (LIKE '%term%' queries)
        Schema::table('products', function (Blueprint $table) {
            $table->fullText(['name', 'description'], 'idx_products_search');
        });

        // Orders: status is filtered frequently in admin panel
        Schema::table('orders', function (Blueprint $table) {
            $table->index('status', 'idx_orders_status');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_stock');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_created_at');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_search');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_status');
        });
    }
};
