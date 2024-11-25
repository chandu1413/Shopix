<?php

namespace Modules\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

// use Modules\Ecommerce\Database\Factories\ProductBrandFactory;

class ProductBrand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'logo',
        'website_url',
        'meta_title',
        'meta_description',
        'keywords',
        'status',
    ];

    // Define the relationship with the Product model
    public function products()
    {
        return $this->hasMany(Product::class);
    }

  
    public function getLogoFullUrlAttribute()
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }
}
