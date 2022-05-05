<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'civicrm_campaign';

    // @todo public function campaignType(): BelongsTo

    // @todo public function status(): BelongsTo

    // @todo public function parent(): BelongsTo
    
    public function scopeActive($query): Builder
    {
        return $query->where('is_active', 1);
    }
}
