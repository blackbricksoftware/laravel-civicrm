<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use BlackBrickSoftware\LaravelCiviCRM\Scopes\SoftDeletesScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'civicrm_contact';

    protected static function booted()
    {
        static::addGlobalScope(new SoftDeletesScope);
    }

    public function prefix(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'prefix_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'individual_prefix'));
        return $relation;
    }

    public function suffix(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'suffix_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'individual_suffix'));
        return $relation;
    }

    // @todo
    // public function preferredCommunicationMethods(): BelongsToMany
    // {
    //     return $this->belongsToMany(OptionValue::class);
    // }

    public function communicationStyle(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'communication_style_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'communication_style'));
        return $relation;
    }

    public function emailGreeting(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'email_greeting_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'email_greeting'));
        return $relation;
    }

    public function postalGreeting(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'postal_greeting_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'postal_greeting'));
        return $relation;
    }

    public function addressee(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'addressee_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'addressee'));
        return $relation;
    }

    public function gender(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'gender_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'gender'));
        return $relation;
    }

    public function primaryContact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'primary_contact_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'employer_id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Phone::class);
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
            ->wherePivot('record_type_id', $projectRelationshipValue->value);
    }

    public function managedVolunteerProjects(): BelongsToMany
    {
        $projectRelationshipValue = $this->getVolunteerProjectRelationshipValue('volunteer_manager');
        return $this->belongsToMany(VolunteerProject::class, VolunteerProjectContact::class)
            ->wherePivot('record_type_id', $projectRelationshipValue->value);
    }

    public function beneficiaryVolunteerProjects(): BelongsToMany
    {
        $projectRelationshipValue = $this->getVolunteerProjectRelationshipValue('volunteer_beneficiary');
        return $this->belongsToMany(VolunteerProject::class, VolunteerProjectContact::class)
            ->wherePivot('record_type_id', $projectRelationshipValue->value);
    }

    protected function getVolunteerProjectRelationshipValue(string $name): OptionValue
    {
        $ov = OptionValue::where('name', $name)
            ->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'volunteer_project_relationship'))
            ->firstOrFail();
        return $ov;
    }
}
