<?php

namespace BlackBrickSoftware\LaravelCivicrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerProject extends Model
{
    use HasFactory;

    protected $table = 'civicrm_volunteer_project';

    protected $casts = [
        'id' => 'int',
    ];
}
