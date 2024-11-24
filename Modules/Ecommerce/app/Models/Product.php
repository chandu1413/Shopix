<?php

namespace Modules\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
 
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'sku',
        'category_id',
        'subcategory_id',
        'price',
        'discount_price',
        'currency',
        'quantity',
        'stock_status',
        'images',
        'product_image',
        'variants',
        'weight',
        'dimensions',
        'brand_id', // Ensure this matches the column name in the database
        'tags',
        'shipping_info',
        'return_policy',
        'customer_reviews',
        'technical_specs',
        'compatibility_info',
        'compliance_info',
    ];

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    /**
     * Get the subcategory that owns the product.
     */
    public function subcategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'subcategory_id');
    }

    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }
}