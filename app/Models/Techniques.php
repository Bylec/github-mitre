<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Techniques extends Model
{
    protected $connection = 'mongodb';

    protected $primaryKey = 'id';

    protected $guarded = [];
}
