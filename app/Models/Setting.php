<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    public static function get(string $key, $default = null)
    {
        return Cache::rememberForever("setting_{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public static function set(string $key, $value, string $group = 'general', string $type = 'text'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'type' => $type]
        );

        Cache::forget("setting_{$key}");
        Cache::forget('all_settings_grouped');

        return $setting;
    }

    public static function getAllGrouped(): array
    {
        return Cache::rememberForever('all_settings_grouped', function () {
            $settings = static::all();
            $grouped = [];
            foreach ($settings as $setting) {
                $grouped[$setting->key] = $setting->value;
            }
            return $grouped;
        });
    }
}
