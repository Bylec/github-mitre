<?php

namespace App\Mitre\Sources;

interface DataSourceInterface
{
    /**
     * Prepares source data for update mitre data mechanism
     *
     * @return array
     */
    public function prepareData(): array;
}
