<?php

namespace Modules\Ecommerce\Repositories;

use Modules\Ecommerce\Models\Transaction;

class TransactionRepository
{
    public function handle()
    {
        //
    }

     /**
     * Create a new Transaction.
     *
     * @param array $data
     * @return Transaction
     */
    public function create(array $data): Transaction 
    {
        return Transaction::create($data); // Assuming you have mass assignment set up
    }

    /**
     * Update an existing Transaction.
     *
     * @param array $data
     * @param int $id
     * @return Transaction
     * @throws ModelNotFoundException
     */
    public function update(array $data, int $id): Transaction 
    {
        $Transaction = Transaction::findOrFail($id); // This will throw an exception if not found
        $Transaction->update($data);
        return $Transaction;
    }

    /**
     * Delete a Transaction by its ID.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool 
    {
        $Transaction = Transaction::findOrFail($id); // This will throw an exception if not found
        return $Transaction->delete();
    }
    
    /**
     * Get a Transaction by its ID.
     *
     * @param int $id
     * @return Transaction
     * @throws ModelNotFoundException
     */
    public function get(int $id): Transaction 
    {
        return Transaction::findOrFail($id); // This will throw an exception if not found
    }

    /**
     * Get all Transactions with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return Transaction[]
     */
    public function getAll(array $filters = [], int $perPage = 10) 
    {
        // You can add filtering logic here based on $filters
        return Transaction::where($filters)->paginate($perPage)->items(); // Return paginated items
    }
}
