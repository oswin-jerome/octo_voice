<?php

namespace App\Models;

use App\Traits\HasFilterable;
use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory, HasSearchable, HasFilterable;
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
        return $this->belongsToMany(Deliverable::class)->withPivot('quantity');
    }

    public function taxes()
    {
        return $this->morphToMany(Tax::class, 'taxable');
    }

    public function getSubTotalAttribute()
    {
        return $this->deliverables->sum(function ($deliverable) {
            return $deliverable->pivot->quantity * $deliverable->price;
        });
    }

    public function getTotalAttribute()
    {
        $temp = $this->sub_total;
        $this->taxes()->each(function ($tax) use (&$temp) {
            $temp += $this->sub_total * ($tax->value / 100);
        });
        if ($this->discount_type == "fixed") {
            return $temp - $this->discount;
        }
        return $temp - ($temp * $this->discount) / 100;
    }
    public function getDiscountAmountAttribute()
    {
        if ($this->discount_type == "fixed") {
            return $this->discount;
        }
        return ($this->discount * $this->sub_total) / 100;
    }
}
