<?php

namespace App;

interface RepositoryInterface
{
    /**
     * Get all records.
     *
     * @param array $filters Filters to apply to the query.
     * @param string $searchValue Search term for filtering results.
     * @param int $perPage Number of records to return per page.
     * @return array
     */
    public function getAll(array $filters = [], string $searchValue = '', int $perPage = 10): array;

    /**
     * Find a record by its ID.
     *
     * @param int $id
     * @return mixed
     */
    public function get(int $id);

    /**
     * Create a new record.
     *
     * @param array $data Data for the new record.
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update an existing record.
     *
     * @param int $id Record ID to update.
     * @param array $data Updated data for the record.
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Delete a record by its ID.
     *
     * @param int $id
     * @return bool True if the record was deleted, false otherwise.
     */
    public function delete(int $id): bool;
}