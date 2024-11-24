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
            $table->unsignedBigInteger('category_id'); // Foreign key to product_categories
            $table->unsignedBigInteger('subcategory_id')->nullable(); // Foreign key to product_sub_categories
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('sku');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('currency')->default('USD');
            $table->integer('quantity')->default(0);
            $table->string('stock_status')->default('in_stock');
            $table->text('images')->nullable();
            $table->string('product_image')->nullable();
            $table->json('variants')->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('dimensions')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('tags')->nullable();
            $table->text('shipping_info')->nullable();
            $table->text('return_policy')->nullable();
            $table->text('customer_reviews')->nullable();
            $table->text('technical_specs')->nullable();
            $table->text('compatibility_info')->nullable();
            $table->text('compliance_info')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('product_sub_categories')->onDelete('set null'); // Set to null if the subcategory is deleted
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