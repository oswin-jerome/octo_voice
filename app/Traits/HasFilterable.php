<?php

namespace App\Traits;

trait HasFilterable
{

    public function scopeFilterable($query)
    {
        if (request()->has('sort_by') && request()->get('sort_by') != "") {
            $query->orderBy(request()->sort_by, request()->sort_order ?? "asc");
        }
        return $query;
    }
}
