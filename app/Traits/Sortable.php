<?php

namespace App\Traits;

trait Sortable
{
    /**
     * Scope a query to sort results.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $sort
     * @param mixed $direction
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSort($query, mixed $sort, mixed $direction)
    {
        // Get sortable column
        $sortables = data_get($this, 'sortables', []);

        // Get the direction of which to sort
        $direction = $direction ?? 'asc';

        // Ensure column to sort is part of model's sortables property
        // and that the direction is a valid value
        if ($sort
            && in_array($sort, $sortables)
            && $direction
            && in_array($direction, ['asc', 'desc'])) {
            // Return ordered query
            return $query->orderBy($sort, $direction);
        }

        // No sorting, return query
        return $query;
    }

}
