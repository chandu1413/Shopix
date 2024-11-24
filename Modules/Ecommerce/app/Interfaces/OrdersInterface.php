<?php

namespace Modules\Ecommerce\Interfaces;

use Modules\Ecommerce\Models\Order;

interface OrdersInterface
{
 /**
     * Create a new Order.
     *
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order;

    /**
     * Update an existing Order.
     *
     * @param array $data
     * @param int $id
     * @return Order
     */
    public function update(array $data, int $id): Order;

    /**
     * Delete a Order by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Get a Order by its ID.
     *
     * @param int $id
     * @return Order|null
     */
    public function get(int $id): ?Order;

    /**
 * Get all Orders with optional filters.
 *
 * @param array $filters
 * @param int $perPage
 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
 */
public function getAll(array $filters = [], int $perPage = 10);
}