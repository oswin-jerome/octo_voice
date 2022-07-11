<?php

namespace App\Models;

use App\Traits\HasCalculations;
use App\Traits\HasFilterable;
use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory, HasSearchable, HasFilterable, HasCalculations;
    protected $guarded = [];
    protected $searchable_fields = [
        "valid_till"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function deliverables()
    {
        return $this->belongsToMany(Deliverable::class, 'deliverable_estimate', 'estimate_id', 'deliverable_id')->withPivot(['quantity', 'amount_per_unit']);
    }

    public function taxes()
    {
        return $this->morphToMany(Tax::class, 'taxable');
    }
}
