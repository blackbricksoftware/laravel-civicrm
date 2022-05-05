<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Relationship extends Model
{
    use HasFactory;

    protected $table = 'civicrm_relationship';

    public function relationshipType(): BelongsTo
    {
        return $this->belongsTo(relationshipType::class);
    }

    public function contactA(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id_a');
    }

    public function contactB(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id_b');
    }

    // @todo public function case(): BelongsTo

    public function scopeActive($query): Builder
    {
        return $query->where('is_active', 1);
    }
}
