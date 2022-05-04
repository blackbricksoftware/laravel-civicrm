<?php

namespace BlackBrickSoftware\LaravelCivicrm;

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
}
