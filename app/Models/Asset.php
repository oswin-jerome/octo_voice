<?php

namespace App\Models;

use App\Traits\HasFilterable;
use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    use HasSearchable;
    use HasFilterable;
    protected $searchable_fields = ['name'];
    protected $fillable = [
        'name',
        'description',
        'code',
        'serial_number',
        'manufacturer',
        'model',
        'purchase_date',
        'status',
        'asset_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(AssetTransaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
