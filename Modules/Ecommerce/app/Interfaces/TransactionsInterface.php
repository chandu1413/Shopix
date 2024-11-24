<?php

namespace Modules\Ecommerce\Interfaces;

use Modules\Ecommerce\Models\Transaction;

interface TransactionsInterface
{
    /**
     * Create a new Transaction.
     *
     * @param array $data
     * @return Transaction
     */
    public function create(array $data): Transaction;

    /**
     * Update an existing Transaction.
     *
     * @param array $data
     * @param int $id
     * @return Transaction
     */
    public function update(array $data, int $id): Transaction;

    /**
     * Delete a Transaction by its ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Get a Transaction by its ID.
     *
     * @param int $id
     * @return Transaction|null
     */
    public function get(int $id): ?Transaction;

    /**
     * Get all Transactions.
     *
     * @param array $filters Optional filters for the Transactions.
     * @param int $perPage Number of Transactions per page (for pagination).
     * @return Transaction[]
     */
    public function getAll(array $filters = [], int $perPage = 10);
}
