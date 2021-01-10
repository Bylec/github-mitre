<?php

namespace App\Http\Controllers;

use App\Http\Resources\TacticResource;
use App\Http\Resources\TechniqueResource;
use App\Services\MitreServiceInterface;
use Illuminate\Routing\Controller as BaseController;

class ApiMitreController extends BaseController
{
    private $mitreService;

    public function __construct(MitreServiceInterface $mitreService)
    {
        $this->mitreService = $mitreService;
    }

    public function allTactics()
    {
        return TacticResource::collection($this->mitreService->getAllTactics());
    }

    public function allTechinques()
    {
        return TechniqueResource::collection($this->mitreService->getAllTechniques());
    }

    public function singleTechnique(string $id)
    {
        return new TechniqueResource($this->mitreService->getTechniqueById($id));
    }
}
