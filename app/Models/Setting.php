<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'value'];

    public static function getSetting($key)
    {
        $setting = static::where("key", $key)->first();

        if ($setting) {
            return $setting->value;
        } else {
            return null;
        }
    }
}
