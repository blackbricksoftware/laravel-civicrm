<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait MultipleValueColumn {

  protected function decodeMultipleValueColumn(string $value): Collection
  {
    return Str::of($value)
      ->explode(chr(1))
      ->unique()
      ->filter();
  }

}