<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LocaleString;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        LocaleString::factory(3)->create()->each(function (LocaleString $string) {
            $string->translations()->createMany([
                [
                    'locale' => 'en',
                    'value' => "en:{$string->fallback_value}",
                ],
                [
                    'locale' => 'de',
                    'value' => "de:{$string->fallback_value}",
                ],
                [
                    'locale' => 'it',
                    'value' => "it:{$string->fallback_value}",
                ],
            ]);
        });
    }
}
