<?php

namespace App\Mitre\Sources;

use Exception;

class Enterprise implements DataSourceInterface
{
    /**
     * @inheritDoc
     */
    public function prepareData(): array
    {
        try {
            $file = file_get_contents("https://raw.githubusercontent.com/mitre/cti/master/enterprise-attack/enterprise-attack.json");
            $allEnterpriseData = json_decode($file,true);
            $objectsEnterpriseData = collect($allEnterpriseData["objects"]);

            $tactics = $objectsEnterpriseData->where("type", "x-mitre-tactic");
            $techniques = $objectsEnterpriseData->where("type", "attack-pattern");
        } catch (Exception $exception) {
            \Log::error($exception->getMessage());
            $tactics = collect();
            $techniques = collect();
        }

        return [
            'tactics' => $tactics,
            'techniques' => $techniques
        ];
    }
}
