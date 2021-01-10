<?php

namespace App\Mitre\DatabaseDrivers;

use App\Services\MitreServiceInterface;
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
        $mitreService = app(MitreServiceInterface::class);
        return [
            'tactics' => $mitreService->getAllTactics(),
            'techniques' => $mitreService->getAllTechniques()
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
