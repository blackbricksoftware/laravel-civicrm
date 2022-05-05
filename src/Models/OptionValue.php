<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OptionValue extends Model
{
    use HasFactory;

    protected $table = 'civicrm_option_value';

    protected $casts = [
        'id' => 'int',
    ];

    public function optionGroup(): BelongsTo
    {
      return $this->belongsTo(OptionGroup::class);
    }

    // @todo public function component(): BelongsTo

    // @todo public function domain(): BelongsTo

    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', 1);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    public function scopeOptGroup(Builder $query): Builder
    {
        return $query->where('is_optgroup', 1);
    }

    public function scopeReserved(Builder $query): Builder
    {
        return $query->where('is_reserved', 1);
    }
}
