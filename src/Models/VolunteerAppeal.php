<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VolunteerAppeal extends Model
{
    use HasFactory;

    protected $table = 'civicrm_volunteer_appeal';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function locBlock(): BelongsTo
    {
        return $this->belongsTo(LocBlock::class);
    }
}
