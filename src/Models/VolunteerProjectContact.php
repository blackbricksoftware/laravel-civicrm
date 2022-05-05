<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VolunteerProjectContact extends Model
{
    use HasFactory;

    protected $table = 'civicrm_volunteer_project_contact';

    protected $casts = [
        'id' => 'int',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function getRelationshipType(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'relationship_type_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'volunteer_project_relationship'));
        return $relation;
    }
}
