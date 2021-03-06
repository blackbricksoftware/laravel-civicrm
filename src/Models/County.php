<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class County extends Model
{
    use HasFactory;

    protected $table = 'civicrm_county';

    public function stateProvince(): BelongsTo
    {
        return $this->belongsTo(StateProvince::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }
}
