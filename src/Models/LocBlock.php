<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocBlock extends Model
{
    use HasFactory;

    protected $table = 'civicrm_loc_block';

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function address2(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function email(): BelongsTo
    {
        return $this->belongsTo(Email::class);
    }

    public function email2(): BelongsTo
    {
        return $this->belongsTo(Email::class);
    }
    
    public function phone(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }

    public function phone2(): BelongsTo
    {
        return $this->belongsTo(Phone::class);
    }
        
    public function im(): BelongsTo
    {
        return $this->belongsTo(IM::class);
    }

    public function im2(): BelongsTo
    {
        return $this->belongsTo(IM::class);
    }
}
