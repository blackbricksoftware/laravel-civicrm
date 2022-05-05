<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VolunteerProject extends Model
{
    use HasFactory;

    protected $table = 'civicrm_volunteer_project';

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, VolunteerProjectContact::class);
    }

    public function ownerContacts(): BelongsToMany
    {
        $projectRelationshipValue = $this->getVolunteerProjectRelationshipValue('volunteer_owner');
        return $this->belongsToMany(Contact::class, VolunteerProjectContact::class)
            ->wherePivot('record_type_id', $ov->value);
    }

    public function managerContacts(): BelongsToMany
    {
        $projectRelationshipValue = $this->getVolunteerProjectRelationshipValue('volunteer_manager');
        return $this->belongsToMany(Contact::class, VolunteerProjectContact::class)
            ->wherePivot('record_type_id', 2);
    }

    public function beneficiaryContacts(): BelongsToMany
    {
        $projectRelationshipValue = $this->getVolunteerProjectRelationshipValue('volunteer_beneficiary');
        return $this->belongsToMany(Contact::class, VolunteerProjectContact::class)
            ->wherePivot('record_type_id', $ov->value);
    }

    protected function getVolunteerProjectRelationshipValue(string $name): OptionValue
    {
        $ov = OptionValue::where('name', $name)
            ->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'volunteer_project_relationship'))
            ->firstOrFail();
        return $ov;
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function locBlock(): BelongsTo
    {
        return $this->belongsTo(LocBlock::class);
    }
    
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }
}
