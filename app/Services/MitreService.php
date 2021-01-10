<?php

namespace App\Services;

use App\Models\Tactics;
use App\Models\Techniques;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class MitreService implements MitreServiceInterface
{
    public function getAllTactics(): Collection
    {
        return Tactics::all();
    }

    public function getAllTechniques(): Collection
    {
        return Techniques::all();
    }

    public function getTechniqueById(string $id): ?Techniques
    {
        return Techniques::findOrFail($id);
    }
}
