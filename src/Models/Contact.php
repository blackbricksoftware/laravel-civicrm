<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'civicrm_contact';

    protected $casts = [
        'id' => 'int',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, ActivityContact::class);
    }

    public function assignedActivities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, ActivityContact::class)
            ->wherePivot('record_type_id', 1);
    }

    public function createdActivities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, ActivityContact::class)
            ->wherePivot('record_type_id', 2);
    }

    public function targetedActivities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, ActivityContact::class)
            ->wherePivot('record_type_id', 3);
    }

    public function volunteerProjects(): BelongsToMany
    {
        return $this->belongsToMany(volunteerProject::class, VolunteerProjectContact::class);
    }

    public function ownedVolunteerProjects(): BelongsToMany
    {
        $projectRelationshipValue = $this->getVolunteerProjectRelationshipValue('volunteer_owner');
        return $this->belongsToMany(VolunteerProject::class, VolunteerProjectContact::class)
            ->wherePivot('record_type_id', $ov->value);
    }

    public function managedVolunteerProjects(): BelongsToMany
    {
        $projectRelationshipValue = $this->getVolunteerProjectRelationshipValue('volunteer_manager');
        return $this->belongsToMany(VolunteerProject::class, VolunteerProjectContact::class)
            ->wherePivot('record_type_id', 2);
    }

    public function beneficiaryVolunteerProjects(): BelongsToMany
    {
        $projectRelationshipValue = $this->getVolunteerProjectRelationshipValue('volunteer_beneficiary');
        return $this->belongsToMany(VolunteerProject::class, VolunteerProjectContact::class)
            ->wherePivot('record_type_id', $ov->value);
    }

    protected function getVolunteerProjectRelationshipValue(string $name): OptionValue
    {
        $ov = OptionValue::where('name', $name)
            ->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'volunteer_project_relationship'))
            ->firstOrFail();
        return $ov;
    }
}
