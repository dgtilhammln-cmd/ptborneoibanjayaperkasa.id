<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'type', 'group'];
    protected static array $requestCache = [];
    protected static bool $settingsLoaded = false;

    protected static function booted(): void
    {
        static::saved(fn () => self::clearRequestCache());
        static::deleted(fn () => self::clearRequestCache());
    }

    protected static function clearRequestCache(): void
    {
        self::$requestCache = [];
        self::$settingsLoaded = false;
    }

    public static function get($key, $default = null)
    {
        if (!self::$settingsLoaded) {
            self::query()
                ->select(['key', 'value', 'type'])
                ->get()
                ->each(function (Setting $setting) {
                    self::$requestCache[$setting->key] = ($setting->type === 'json' || $setting->type === 'array')
                        ? json_decode($setting->value, true)
                        : $setting->value;
                });

            self::$settingsLoaded = true;
        }

        return self::$requestCache[$key] ?? $default;
    }
}
