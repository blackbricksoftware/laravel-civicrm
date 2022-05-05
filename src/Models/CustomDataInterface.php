<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface CustomDataInterface
{

  public function entity(): BelongsTo;
}
