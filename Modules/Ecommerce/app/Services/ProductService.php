<?php

namespace Modules\Ecommerce\Services;

use Modules\Ecommerce\Interfaces\ProductsInterface;

class ProductService
{
    protected $ProductsRepository;

    public function __construct(ProductsInterface $ProductsRepository)
    {
        $this->ProductsRepository = $ProductsRepository;
    }
    

    public function createCustomer(array $data)
    {
        return $this->ProductsRepository->create($data);
    }

     /**
     * Get all products with optional filters and pagination.
     *
     * @param array $filters
     * @param int $perPage
     * @param int $page
     * @return Product[]|Paginator
     */
    public function getAllProducts(array $filters = [], int $perPage = 10, int $page = 1)
    {
        return $this->ProductsRepository->getAll($filters, $perPage, $page);
    }
}
