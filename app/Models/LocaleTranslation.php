<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocaleTranslation extends Model implements \Stringable
{
    use HasFactory;

    protected $fillable = [
        'locale_string_key',
        'locale',
        'value',
    ];

    public function string()
    {
        return $this->belongsTo(LocaleString::class, 'locale_string_key', 'key');
    }

    public function getLocaleAttribute(string $locale): string
    {
        return strtolower($locale);
    }

    public function setLocaleAttribute(string $locale): void
    {
        $this->attributes['locale'] = strtolower($locale);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
