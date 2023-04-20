<?php

namespace App\Services;

use App\Models\LocaleString;
use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\Translator;

class LocaleService
{
    public static $locales = [
        ['key' => 'en', 'name' => 'English'],
        ['key' => 'de', 'name' => 'German'],
        ['key' => 'fr', 'name' => 'French'],
        ['key' => 'es', 'name' => 'Spanish'],
        ['key' => 'it', 'name' => 'Italian'],
    ];

    public function __construct(
        protected Translator $translator,
    ) {
        //
    }

    public function getStringsForLocale(string $locale)
    {
        return Cache::remember("locale:{$locale}", now()->addHour(), function () use ($locale) {
            $strings = LocaleString::when($locale !== 'en', function ($query) use ($locale) {
                return $query->with([
                    'translations' => fn ($query) => $query->where('locale', $locale),
                ]);
            })->get();

            return $strings->reduce(function (array $translations, LocaleString $string) use ($locale) {
                return array_merge($translations, [
                    $string->key => $locale !== 'en'
                        ? $string->translations[0]?->value ?? $string->fallback_value
                        : $string->fallback_value,
                ]);
            }, []);
        });
    }
}
