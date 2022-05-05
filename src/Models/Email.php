<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model
{
    use HasFactory;

    protected $table = 'civicrm_email';

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function locationType(): BelongsTo
    {
        return $this->belongsTo(LocationType::class);
    }

    public function onHoldReason(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'on_hold', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'email_on_hold'));
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

    public function scopeBulkMail(Builder $query): Builder
    {
        return $query->where('is_bulkmail', 1);
    }
}
