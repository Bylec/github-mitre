<?php

namespace App\Mitre\DatabaseDrivers;

use App\Models\Tactics;
use App\Models\Techniques;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Mongo implements DatabaseDriverInterface
{
    /**
     * @inheritDoc
     */
    public function getDataSaved(): array
    {
        return [
            'tactics' => Tactics::all(),
            'techniques' => Techniques::all()
        ];
    }

    /**
     * @inheritDoc
     */
    public function insert(Collection $collection, string $collectionName): void
    {
        if ($collection->isNotEmpty()) {
            DB::collection($collectionName)
                ->insert($collection->all());
        }
    }

    /**
     * @inheritDoc
     */
    public function update(Collection $collection, string $collectionName): void
    {
        if ($collection->isNotEmpty()) {
            DB::collection($collectionName)
                ->whereIn('id', $collection->pluck('id'))
                ->delete();

            $this->insert($collection, $collectionName);
        }
    }
}