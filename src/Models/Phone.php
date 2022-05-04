<?php

namespace BlackBrickSoftware\LaravelCivicrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'civicrm_phone';

    protected $casts = [
        'id' => 'int',
    ];
}
