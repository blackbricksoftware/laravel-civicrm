<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IM extends Model
{
    use HasFactory;

    protected $table = 'civicrm_im';

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    // @todo public function locationType()
    
    // @todo public function provider()

    public function scopePrimary(Builder $query): Builder
    {
        return $query->where('is_primary', 1);
    }
}
