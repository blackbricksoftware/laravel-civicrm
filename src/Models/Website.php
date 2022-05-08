<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Website extends Model
{
    use HasFactory;

    protected $table = 'civicrm_website';

    public function websiteType(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'website_type_id', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'website_type'));
        return $relation;
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
