<?php

namespace Modules\Ecommerce\Interfaces;

 

interface ProductBrandInterface
{
    /**
     * Get all product brands.
     *
     * @return mixed
     */
    public function getAllBrands();

    /**
     * Get a specific product brand by its ID.
     *
     * @param int $id
     * @return mixed
     */
    public function getBrandById(int $id);

    /**
     * Create a new product brand.
     *
     * @param array $data
     * @return mixed
     */
    public function createBrand(array $data);

    /**
     * Update an existing product brand.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function updateBrand(int $id, array $data);

    /**
     * Delete a product brand by its ID.
     *
     * @param int $id
     * @return mixed
     */
    public function deleteBrand(int $id);

}
