<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'civicrm_phone';

    protected $casts = [
        'id' => 'int',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function locationType(): BelongsTo
    {
        return $this->belongsTo(LocationType::class);
    }

    public function phoneType(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'phone_type_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'phone_type'));
        return $relation;
    }

    public function mobileProvider(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'mobile_provider_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'mobile_provider'));
        return $relation;
    }

    public function scopePrimary(Builder $query): Builder
    {
        return $query->where('is_primary', 1);
    }

    public function scopeBilling(Builder $query): Builder
    {
        return $query->where('is_primary', 1);
    }    
}
