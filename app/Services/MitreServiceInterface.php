<?php

namespace App\Services;

use App\Models\Techniques;
use Illuminate\Support\Collection;

interface MitreServiceInterface
{
    public function getAllTactics(): Collection;
    public function getAllTechniques(): Collection;
    public function getTechniqueById(string $uid): ?Techniques;
}
