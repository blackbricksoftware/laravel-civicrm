<?php

namespace BlackBrickSoftware\LaravelCivicrm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerProjectContact extends Model
{
    use HasFactory;

    protected $table = 'civicrm_volunteer_project_contact';

    protected $casts = [
        'id' => 'int',
    ];
}
