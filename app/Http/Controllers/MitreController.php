<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTechniques;
use App\Models\Tactics;
use App\Models\Techniques;
use App\Services\MitreServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class MitreController extends BaseController
{
    private $mitreService;

    public function __construct(MitreServiceInterface $mitreService)
    {
        $this->mitreService = $mitreService;
    }

    public function index()
    {
        $tactics = $this->mitreService->getAllTactics();

        return view('index', [
            'tactics' => $tactics
        ]);
    }

    public function tactic(string $shortName)
    {
        $tactics = $this->mitreService->getAllTactics();

        $tactic = Tactics::findOrFail($shortName);

        return view('techniques', [
            'tactics' => $tactics,
            'techniques' => $tactic->techniques
                ->sortBy('external_references.0.external_id')
        ]);
    }

    public function technique(string $id)
    {
        $tactics = $this->mitreService->getAllTactics();

        $technique = Techniques::findOrFail($id);

        return view('technique', [
            'tactics' => $tactics,
            'technique' => $technique
        ]);
    }

    public function searchTechnique(SearchTechniques $request)
    {
        $tactics = $this->mitreService->getAllTactics();

        $techniques = Techniques::where('name', 'like', "%" . $request->technique_name . "%")
            ->get();

        if ($techniques) {
            return view('techniques', [
                'tactics' => $tactics,
                'techniques' => $techniques
                    ->sortBy('external_references.0.external_id')
            ]);
        }

        return redirect()->back();
    }
}
