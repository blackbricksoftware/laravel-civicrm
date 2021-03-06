<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocationType extends Model
{
    use HasFactory;

    protected $table = 'civicrm_location_type';

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function scopeReserved(Builder $query): Builder
    {
        return $query->where('is_reserved', 1);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', 1);
    }
}
