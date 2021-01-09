<?php

namespace App\Mitre\DatabaseDrivers;

use Illuminate\Support\Collection;

interface DatabaseDriverInterface
{
    /**
     * Gets database data for update mitre data mechanism
     *
     * @return array
     */
    public function getDataSaved(): array;

    /**
     * Inserts mitre data to database
     *
     * @param Collection $collection
     * @param string $collectionName
     */
    public function insert(Collection $collection, string $collectionName): void;

    /**
     * Updates mitre data
     *
     * @param Collection $collection
     * @param string $collectionName
     */
    public function update(Collection $collection, string $collectionName): void;
}
