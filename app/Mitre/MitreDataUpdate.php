<?php

namespace App\Mitre;

use App\Mitre\Comparators\TacticsComparator;
use App\Mitre\Comparators\TechniquesComparator;
use App\Mitre\DatabaseDrivers\DatabaseDriverInterface;
use App\Mitre\Sources\DataSourceInterface;

class MitreDataUpdate
{
    /**
     * @var DatabaseDriverInterface
     */
    private $databaseDriver;
    /**
     * @var DataSourceInterface
     */
    private $dataSourceType;

    /**
     * @var string[]
     */
    private $comparators = [
        TacticsComparator::class,
        TechniquesComparator::class
    ];

    /**
     * MitreDataUpdate constructor.
     * @param DatabaseDriverInterface $databaseDriver
     * @param DataSourceInterface $dataSourceType
     */
    public function __construct(DatabaseDriverInterface $databaseDriver, DataSourceInterface $dataSourceType)
    {
        $this->databaseDriver = $databaseDriver;
        $this->dataSourceType = $dataSourceType;
    }

    /**
     * @param DataSourceInterface $dataSourceType
     */
    public function setDataSourceType(DataSourceInterface $dataSourceType)
    {
        $this->dataSourceType = $dataSourceType;
    }

    /**
     * Runs mechanism for update mitre data
     */
    public function update(): void
    {
        $tacticsAndTechniquesFromDataSource = $this->dataSourceType->prepareData();
        $tacticsAndTechniquesFromDatabase = $this->databaseDriver->getDataSaved();

        foreach ($this->comparators as $comparator) {
            $collectionName = $comparator::getCollectionName();
            $comparatorInstance = new $comparator(
                $tacticsAndTechniquesFromDatabase[$collectionName],
                $tacticsAndTechniquesFromDataSource[$collectionName]
            );
            $comparatorInstance->compare();

            $this->databaseDriver->insert(
                $comparatorInstance->getEntriesToInsert(),
                $collectionName
            );
            $this->databaseDriver->update(
                $comparatorInstance->getEntriesToUpdate(),
                $collectionName
            );
        }
    }
}
