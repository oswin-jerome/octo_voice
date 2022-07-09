<?php

namespace App\Models;

use App\Traits\HasFilterable;
use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverable extends Model
{
    use HasFactory, HasSearchable, HasFilterable;
    protected $guarded = [];
    protected $searchable_fields = [
        "name",
        "description",
        "price",
        "unit"
    ];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot(['quantity', 'amount_per_unit']);
    }
}
