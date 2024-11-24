<?php

namespace Modules\Ecommerce\Repositories;

use Modules\Ecommerce\Interfaces\ProductsInterface;
use Modules\Ecommerce\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductRepository implements ProductsInterface
{
    /**
     * Create a new product.
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product 
    {
        return Product::create($data); // Assuming you have mass assignment set up
    }

    /**
     * Update an existing product.
     *
     * @param array $data
     * @param int $id
     * @return Product
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): Product 
    {
        $product = Product::findOrFail($id); // This will throw an exception if not found
        $product->update($data);
        return $product;
    }

    /**
     * Delete a product by its ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool 
    {
        $product = Product::findOrFail($id); // This will throw an exception if not found
        return $product->delete();
    }
    
    /**
     * Get a product by its ID.
     *
     * @param int $id
     * @return Product
     * @throws ModelNotFoundException
     */
    public function get(int $id): Product 
    {
        return Product::findOrFail($id); // This will throw an exception if not found
    }

    /**
     * Get all products with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return Product[]
     */
    public function getAll(array $filters = [], int $perPage = 10): array 
    {
        // You can add filtering logic here based on $filters
        return Product::where($filters)->paginate($perPage)->items(); // Return paginated items
    }
}