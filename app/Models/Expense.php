<?php

namespace App\Models;

use App\Traits\HasFilterable;
use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, HasSearchable, HasFilterable;
    protected $guarded = [];
    protected $searchable_fields = [
        'id',
        'amount',
        'description',
        'invoice_id',
        'created_at',
        'updated_at',
    ];
    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }
}
