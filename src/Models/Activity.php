<?php

namespace BlackBrickSoftware\LaravelCiviCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'civicrm_activity';

    protected $casts = [
        'id' => 'int',
    ];
}
