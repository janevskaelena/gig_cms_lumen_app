<?php

namespace App\Traits;

trait Relational {

    /**
     * add relations.
     *
     * @param  $builder: query builder.
     * @param  $relations: array of filters.
     * @return query builder.
     */
    public function scopeIncludeRelation($builder, $relations = [])
    {
        if(!$relations) {
            return $builder;
        }
        foreach ($relations as $field => $value) {
            if(in_array($value, $this->relationWith ?? []) && $field != 'with') {
                $builder->with($value);
            }
        }
        return $builder;
    }
}
