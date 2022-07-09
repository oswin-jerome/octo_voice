<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    public function taxable()
    {
        return $this->morphTo();
    }

    public function invoices()
    {
        return $this->morphedByMany(Invoice::class, 'taxable');
    }
}
