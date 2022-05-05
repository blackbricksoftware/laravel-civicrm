<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $table = 'civicrm_address';

    public function locationType(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'activity_type_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'activity_type'));
        return $relation;
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    public function stateProvince(): BelongsTo
    {
        return $this->belongsTo(StateProvince::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function scopePrimary(Builder $query): Builder
    {
        return $query->where('is_primary', 1);
    }

    public function scopeBilling(Builder $query): Builder
    {
        return $query->where('is_billing', 1);
    }
}
