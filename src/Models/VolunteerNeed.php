<?php

namespace BlackBrickSoftware\LaravelCivicrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerNeed extends Model
{
    use HasFactory;

    protected $table = 'civicrm_volunteer_need';

    protected $casts = [
        'id' => 'int',
    ];
}
