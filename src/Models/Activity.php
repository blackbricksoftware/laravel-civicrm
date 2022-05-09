<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use BlackBrickSoftware\LaravelCiviCRM\Scopes\SoftDeletesScope;
use BlackBrickSoftware\LaravelCiviCRM\Scopes\VersioningScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'civicrm_activity';

    protected $casts = [
        'activity_date_time' => 'datetime:Y-m-d',
        'created_date' => 'datetime:Y-m-d H:i:s',
        'modified_date' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new SoftDeletesScope);
        static::addGlobalScope(new VersioningScope);
    }

    public function activityType(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'activity_type_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'activity_type'));
        return $relation;
    }

    // @todo public function sourceRecord(): BelongsTo

    public function phone(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }

    public function status(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'status_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'activity_status'));
        return $relation;
    }

    public function priority(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'priority_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'priority'));
        return $relation;
    }

    public function medium(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'medium_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'encounter_medium'));
        return $relation;
    }

    public function relationship(): BelongsTo
    {
        return $this->belongsTo(Relationship::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function originalActivity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'original_id');
    }

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, ActivityContact::class);
    }

    public function assignedContact(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, ActivityContact::class)
            ->wherePivot('record_type_id', 1);
    }

    public function creatorContacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, ActivityContact::class)
            ->wherePivot('record_type_id', 2);
    }

    public function targetedContacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, ActivityContact::class)
            ->wherePivot('record_type_id', 3);
    }
}
