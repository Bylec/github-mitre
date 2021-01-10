<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTechniques;
use App\Models\Tactics;
use App\Models\Techniques;
use App\Services\MitreServiceInterface;
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
        return view('app');
    }

    public function tactic(string $shortName)
    {
        $tactic = Tactics::findOrFail($shortName);

        return view('techniques', [
            'techniques' => $tactic->techniques
                ->sortBy('external_references.0.external_id')
        ]);
    }

    public function technique(string $id)
    {
        $technique = Techniques::findOrFail($id);

        return view('technique', [
            'technique' => $technique
        ]);
    }

    public function searchTechnique(SearchTechniques $request)
    {
        $techniques = Techniques::where('name', 'like', '%' . $request->technique_name . '%')
            ->get();

        if ($techniques) {
            return view('techniques', [
                'techniques' => $techniques
                    ->sortBy('external_references.0.external_id')
            ]);
        }

        return redirect()->back();
    }
}
