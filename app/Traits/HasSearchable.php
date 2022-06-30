<?php

namespace App\Traits;

use Str;

trait HasSearchable
{
    public function scopeSearchable($query)
    {

        if (request()->has('search')) {
            $searchString = request()->get('search');
            foreach ($this->searchable_fields as $key => $value) {
                $query->orWhere($value, "like", "%" . $searchString . "%");
            }
        } else {

            foreach ($this->searchable_fields as $key => $value) {
                $comparison = $this->getComparisonMethod($value);
                if (!request()->has("search_" . $value)) {
                    continue;
                }

                $searchTerm = request()->get("search_" . $value);
                if ($comparison == "like") {
                    $searchTerm = "%" . $searchTerm . "%";
                }
                $re = '/[a-zA-Z]{1,}\.[a-zA-Z]{1,}/m';
                $str = 'user.subjects';
                if (preg_match($re, $value)) {
                    // Relation
                    $searchTerm = request()->get("search_" . Str::replace(".", "_", $value));
                    if ($comparison == "like") {
                        $searchTerm = "%" . $searchTerm . "%";
                    }
                    dd($searchTerm);

                    $query->whereHas("subjects", function ($q) use ($searchTerm, $comparison) {
                        $q->where("name", $comparison, $searchTerm);
                    })->with(["subjects" => function ($q) use ($searchTerm, $comparison) {
                        $q->where("name", $comparison, $searchTerm);
                    }]);
                } else {


                    if (request()->has("search_" . $value)) {
                        $query->where($value, $comparison,  $searchTerm);
                    }
                }
            }
        }

        return $query;
    }

    public function getComparisonMethod($val)
    {
        $comparison = "like";

        if (request()->has("search_" . $val . "_equal")) {
            $comparison = "=";
        }
        return $comparison;
    }
}
