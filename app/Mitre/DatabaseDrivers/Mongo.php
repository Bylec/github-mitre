<?php

namespace App\Mitre\DatabaseDrivers;

use App\Models\Tactics;
use App\Models\Techniques;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Mongo implements DatabaseDriverInterface
{
    /**
     * @inheritDoc
     */
    public function getDataSaved(): array
    {
        return [
            'tactics' => Cache::rememberForever('tactics_all', function () {
                return Tactics::all();
            }),
            'techniques' => Cache::rememberForever('techniques_all', function () {
                return Techniques::all();
            }),
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

            Cache::forget($collectionName . '_all');
        }
    }

    /**
     * @inheritDoc
     */
    public function update(Collection $collection, string $collectionName): void
    {
        if ($collection->isNotEmpty()) {
            DB::transaction(function() use ($collection, $collectionName) {
                DB::collection($collectionName)
                    ->whereIn('id', $collection->pluck('id'))
                    ->delete();

                $this->insert($collection, $collectionName);
            });
        }
    }
}
