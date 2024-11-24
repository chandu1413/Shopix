<?php

namespace Modules\Ecommerce\Interfaces;

use Modules\Ecommerce\Models\Product;

interface ProductsInterface
{
    /**
     * Create a new product.
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product;

    /**
     * Update an existing product.
     *
     * @param array $data
     * @param int $id
     * @return Product
     */
    public function update(array $data, int $id): Product;

    /**
     * Delete a product by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Get a product by its ID.
     *
     * @param int $id
     * @return Product|null
     */
    public function get(int $id): ?Product;

    /**
     * Get all products.
     *
     * @param array $filters Optional filters for the products.
     * @param int $perPage Number of products per page (for pagination).
     * @return Product[]
     */
    public function getAll(array $filters = [], int $perPage = 10): array;
}