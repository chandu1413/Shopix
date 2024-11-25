<?php

namespace Modules\Ecommerce\Services;

use Modules\Ecommerce\Interfaces\ProductBrandInterface;

class ProductBrandService
{
    protected $productBrandRepository;

    public function __construct(ProductBrandInterface $productBrandRepository)
    {
        $this->productBrandRepository = $productBrandRepository;
    }

    public function getAllBrands()
    {
        return $this->productBrandRepository->getAllBrands();
    }

    public function getBrandById(int $id)
    {
        return $this->productBrandRepository->getBrandById($id);
    }

    public function createBrand(array $data)
    {
        return $this->productBrandRepository->createBrand($data);
    }

    public function updateBrand(int $id, array $data)
    {
        return $this->productBrandRepository->updateBrand($id, $data);
    }

    public function deleteBrand(int $id)
    {
        return $this->productBrandRepository->deleteBrand($id);
    }
}
