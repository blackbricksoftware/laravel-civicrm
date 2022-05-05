<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OptionGroup extends Model
{
    use HasFactory;

    protected $table = 'civicrm_option_group';

    public function optionValues(): HasMany
    {
      return $this->hasMany(OptionValue::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    public function scopeReserved(Builder $query): Builder
    {
        return $query->where('is_reserved', 1);
    }

    public function scopeLocked(Builder $query): Builder
    {
        return $query->where('is_locked', 1);
    }
}
