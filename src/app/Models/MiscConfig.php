<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MiscConfig extends Model
{

    protected $fillable = ['key', 'value'];

    public function scopeOfKey(Builder $query, $key): Builder
    {
        return $query->where('key', $key);
    }

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        if ($setting) {
            return $setting->value;
        }
        return $default;
    }

    public static function put($key, $value)
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
