<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityContact extends Model
{
    use HasFactory;

    protected $table = 'civicrm_activity_contact';

    protected $casts = [
        'id' => 'int',
    ];

    public function contact(): BelongsTo
    {
      return $this->belongsTo(Contact::class);
    }

    public function activity(): BelongsTo
    {
      return $this->belongsTo(Activity::class);
    }

    public function getRecordTypeAttribute(): ?string
    {
      return match($this->record_type_id) {
        1 => 'assignee',
        2 => 'creator',
        3 => 'target',
        default => null,
      };
    }
}
