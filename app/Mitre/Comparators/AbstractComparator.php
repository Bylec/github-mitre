<?php

namespace App\Mitre\Comparators;

use Illuminate\Support\Collection;

abstract class AbstractComparator
{
    /**
     * @var Collection
     */
    protected $fromDatabase;

    /**
     * @var Collection
     */
    protected $fromDataSource;

    /**
     * @var Collection
     */
    protected $entriesToInsert;

    /**
     * @var Collection
     */
    protected $entriesToUpdate;

    /**
     * AbstractComparator constructor.
     * @param Collection $fromDatabase
     * @param Collection $fromDataSource
     */
    public function __construct(Collection $fromDatabase, Collection $fromDataSource)
    {
        $this->fromDatabase = $fromDatabase;
        $this->fromDataSource = $fromDataSource;

        $this->entriesToInsert = collect();
        $this->entriesToUpdate = collect();
    }

    abstract public function compare(): void;

    /**
     * Returns entries to insert to Db
     *
     * @return Collection
     */
    public function getEntriesToInsert(): Collection
    {
        return $this->entriesToInsert;
    }

    /**
     * Returns entries to update
     *
     * @return Collection
     */
    public function getEntriesToUpdate(): Collection
    {
        return $this->entriesToUpdate;
    }
}
