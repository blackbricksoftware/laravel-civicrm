<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationshipType extends Model
{
    use HasFactory;

    protected $table = 'civicrm_relationship_type';

    protected $casts = [
        'id' => 'int',
    ];

    public function scopeActive($query): Builder
    {
        return $query->where('is_active', 1);
    }
}
