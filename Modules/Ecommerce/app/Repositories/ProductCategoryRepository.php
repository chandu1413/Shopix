<?php

namespace Modules\Ecommerce\Repositories;

use Modules\Ecommerce\Interfaces\ProductCategoryInterface;
use Modules\Ecommerce\Models\ProductCategory;

class ProductCategoryRepository implements ProductCategoryInterface
{
    protected $category;

    public function __construct(ProductCategory $category)
    {
        $this->category = $category; // Inject the model
    }

    public function create(array $data)
    {
        return $this->category->create($data); // Return the created category
    }

    public function update(int $id, array $data)
    {
        $category = $this->category->find($id);
        if (!$category) {
            return null; // Return null if not found
        }
        $category->update($data);
        return $category; // Return the updated category
    }

    public function delete(int $id): bool
    {
        $category = $this->category->find($id);
        if (!$category) {
            return false; // Return false if not found
        }
        return $category->delete(); // Return the result of the delete operation
    }

    public function get(int $id)
    {
        return $this->category->find($id); // Return the found category or null
    }

    public function getAll(array $filters = [], string $searchValue = '', int $perPage = 10, int $currentPage = 1): array
    {
        $query = $this->category->newQuery();

        // Apply filters
        if (!empty($filters)) {
            foreach ($filters as $key => $value) {
                $query->where($key, $value);
            }
        }
         

        // Apply search functionality
        if (!empty($searchValue)) {
            $query->where('name', 'LIKE', '%' . $searchValue . '%');
        }

        // Paginate // Paginate the results
        $categories = $query->paginate($perPage, ['*'], 'page', $currentPage);

        return [
            'total' => $categories->total(),
            'perPage' => $perPage,
            'currentPage' => $currentPage,
            'data' => $categories->items(),
        ];
    }
}