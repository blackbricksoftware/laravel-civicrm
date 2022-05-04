<?php

namespace BlackBrickSoftware\LaravelCivicrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'civicrm_address';

    protected $casts = [
        'id' => 'int',
    ];
}
