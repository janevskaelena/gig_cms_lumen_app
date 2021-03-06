<?php

namespace App\Traits;

trait Filterable {

    /**
     * add filtering.
     *
     * @param  $builder: query builder.
     * @param  $filters: array of filters.
     * @return query builder.
     */
    public function scopeFilter($builder, $filters = [])
    {
        if(!$filters) {
            return $builder;
        }
        $tableName = $this->getTable();
        foreach ($filters as $field => $value) {
            if(in_array($field, $this->equalsFilterFields ?? []) && $value != null) {
                $builder->where($field, $value);
                continue;
            }
            if(!in_array($field, $this->fillable ?? []) || !$value) {
                continue;
            }
            if(in_array($field, $this->likeFilterFields ?? [])) {
                $builder->where($tableName.'.'.$field, 'LIKE', "%$value%");
            } else if(is_array($value)) {
                $builder->whereIn($field, $value);
            } else {
                $builder->where($field, $value);
            }
        }
        return $builder;
    }
}
