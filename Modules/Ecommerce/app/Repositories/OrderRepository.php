<?php

namespace Modules\Ecommerce\Repositories;

use Modules\Ecommerce\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Ecommerce\Interfaces\OrdersInterface;

class OrderRepository implements OrdersInterface // Implement the appropriate interface
{
    /**
     * Create a new Order.
     *
     * @param array $data
     * @return Order
     */
    public function create(array $data): Order
    {
        return Order::create($data); // Assuming you have mass assignment set up
    }

    /**
     * Update an existing Order.
     *
     * @param array $data
     * @param int $id
     * @return Order
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): Order 
    {
        $order = Order::findOrFail($id); // This will throw an exception if not found
        $order->update($data);
        return $order;
    }

    /**
     * Delete an Order by its ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool 
    {
        $order = Order::findOrFail($id); // This will throw an exception if not found
        return $order->delete();
    }
    
    /**
     * Get an Order by its ID.
     *
     * @param int $id
     * @return Order
     * @throws ModelNotFoundException
     */
    public function get(int $id): Order 
    {
        return Order::findOrFail($id); // This will throw an exception if not found
    }

    /**
     * Get all Orders with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll(array $filters = [], $searchvalue= '' , int $perPage = 10) 
    {
        // You can add filtering logic here based on $filters
        return Order::where($filters)->paginate($perPage)->items(); // Return paginated items
    }
}