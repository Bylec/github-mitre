<?php

namespace App\Mitre\Comparators;

use Carbon\Carbon;

class TacticsComparator extends AbstractComparator
{
    /**
     * @inheritDoc
     */
    public function compare(): void
    {
        $this->fromDataSource->each(function($tactic) {
            $tacticFromDatabase = $this->fromDatabase->firstWhere('id', $tactic['id']);

            if (!$tacticFromDatabase) {
                $this->entriesToInsert->push($tactic);
                return;
            }

            if ($tacticFromDatabase->modified < Carbon::parse($tactic['modified'])) {
                $this->entriesToUpdate->push($tactic);
            }
        });
    }

    /**
     * @inheritDoc
     */
    public static function getCollectionName(): string
    {
        return 'tactics';
    }
}
