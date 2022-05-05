<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    use HasFactory;

    protected $table = 'civicrm_contact_type';

}
