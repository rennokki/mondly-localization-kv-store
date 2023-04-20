<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocaleString extends Model implements \Stringable
{
    use HasFactory;

    protected $fillable = [
        'key',
        'fallback_value',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $keyName = 'key';

    public function translations()
    {
        return $this->hasMany(LocaleTranslation::class, 'locale_string_key', 'key');
    }

    public function __toString(): string
    {
        return $this->fallback_value;
    }
}
