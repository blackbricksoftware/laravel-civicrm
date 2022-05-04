<?php

namespace BlackBrickSoftware\LaravelCiviCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerAppeal extends Model
{
    use HasFactory;

    protected $table = 'civicrm_volunteer_appeal';

    protected $casts = [
        'id' => 'int',
    ];
}
