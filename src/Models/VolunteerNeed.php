<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VolunteerNeed extends Model
{
    use HasFactory;

    protected $table = 'civicrm_volunteer_need';

    public function project(): BelongsTo
    {
        return $this->belongsTo(VolunteerProject::class);
    }

    public function role(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'role_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'volunteer_role'));
        return $relation;
    }

    public function visibility(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'visibility_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'visibility'));
        return $relation;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    public function scopeFlexible(Builder $query): Builder
    {
        return $query->where('is_flexible', 1);
    }
}
