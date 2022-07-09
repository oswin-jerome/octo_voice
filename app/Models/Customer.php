<?php

namespace App\Models;

use App\Traits\HasFilterable;
use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable, HasSearchable, HasFilterable;

    protected $guarded = [];
    protected $searchable_fields = [
        "name",
        "email",
        "phone",
        "address",
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
