<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'asset_id',
        'user_id',
        'type',
        'purpose',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
