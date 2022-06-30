<?php

namespace App\Traits;

trait HasFilterable
{

    public function scopeFilterable($query, $default_field = "id", $default_operator = "asc")
    {


        if (request()->has('sort_by') && request()->get('sort_by') != "") {
            $query->orderBy(request()->sort_by, request()->sort_order ?? "asc");
        } else {
            $query->orderBy($default_field, $default_operator);
        }
        return $query;
    }
}
