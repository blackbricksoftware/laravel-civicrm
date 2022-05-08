<?php

namespace BlackBrickSoftware\LaravelCiviCRM\Traits;

use BlackBrickSoftware\LaravelCiviCRM\Models\OptionValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Handle Multiple valued columns
 * Loosely based on: https://stackoverflow.com/a/27900746
 */
trait MultipleOptionValueColumn {

  protected function decodeMultipleValueColumn(string $value): Collection
  {
    return Str::of($value)
      ->explode(chr(1))
      ->unique()
      ->filter();
  }

  protected function createMultipleOptionValueAttribute(string $columnName, string $optionGroupName, ?string $relationName = null): EloquentCollection
  {

    // Create at relation name if necessary
    if ($relationName === null) {
      $relationName = Str::camel($columnName);
    }

    // Load up the option values
    if (!$this->relationLoaded($relationName)) {
      $query = $this->createMultipleOptionValueQuery($columnName, $optionGroupName);
      $related = $query->get();
      $this->setRelation($relationName, $related);
    }

    return $this->getRelation($relationName);
  }

  protected function createMultipleOptionValueQuery(string $columnName, string $optionGroupName): Builder
  {
    $values = $this->decodeMultipleValueColumn($this->$columnName);
    return OptionValue::whereIn('value', $values)
      ->whereHas('optionGroup', fn(Builder $q) => $q->where('name', $optionGroupName));
  }
}