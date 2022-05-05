<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorldRegion extends Model
{
    use HasFactory;

    protected $table = 'civicrm_worldregion';

    protected $casts = [
        'id' => 'int',
    ];
}
