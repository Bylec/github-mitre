<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Tactics extends Model
{
    protected $connection = 'mongodb';

    protected $primaryKey = 'x_mitre_shortname';

    protected $guarded = [];

    public function techniques()
    {
        return $this->hasMany(Techniques::class, 'kill_chain_phases.phase_name');
    }
}
