<?php

namespace BlackBrickSoftware\LaravelCiviCRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ActivityContact extends Model
{
    use HasFactory;

    protected $table = 'civicrm_activity_contact';

    protected $casts = [
        'id' => 'int',
        'activity_id' => 'int',
        'contact_id' => 'int',
        'record_type_id' => 'int',
    ];

    public function activity(): HasOne
    {
      return $this->hasOne(Activity::class);
    }

    public function activity(): HasOne
    {
      return $this->hasOne();
    }
}
