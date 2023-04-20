<?php

namespace Tests\Feature;

use App\Models\LocaleString;
use App\Services\Locale;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TranslateTest extends TestCase
{
    use DatabaseMigrations;

    public function test_get_translations()
    {
        [$welcome, $bye, $hello] = LocaleString::factory(3)->sequence(
            ['key' => 'WELCOME_TEXT', 'fallback_value' => 'Hello!'],
            ['key' => 'BYE_TEXT', 'fallback_value' => 'Bye!'],
            ['key' => 'HELLO_WORLD', 'fallback_value' => 'Hello, World!'],
        )->create();

        $welcome->translations()->createMany([
            ['locale' => 'en', 'value' => 'Hello!'],
            ['locale' => 'de', 'value' => 'Hallo!'],
            // ['locale' => 'fr', 'value' => 'Bonjour!'],
        ]);

        $bye->translations()->createMany([
            ['locale' => 'en', 'value' => 'Bye!'],
            // ['locale' => 'de', 'value' => 'Auf Wiedersehen!'],
            ['locale' => 'fr', 'value' => 'Au revoir!'],
        ]);

        $hello->translations()->createMany([
            ['locale' => 'en', 'value' => 'Hello, World!'],
            ['locale' => 'de', 'value' => 'Hallo, Welt!'],
            ['locale' => 'fr', 'value' => 'Bonjour, le monde!'],
        ]);

        $this->assertSame(
            [
                'BYE_TEXT' => 'Au revoir!',
                'HELLO_WORLD' => 'Bonjour, le monde!',
                'WELCOME_TEXT' => 'Hello!',
            ],
            $this->app->make(Locale::class)->getStringsForLocale('fr'),
        );

        $this->assertSame(
            [
                'BYE_TEXT' => 'Bye!',
                'HELLO_WORLD' => 'Hallo, Welt!',
                'WELCOME_TEXT' => 'Hallo!',
            ],
            $this->app->make(Locale::class)->getStringsForLocale('de'),
        );

        $this->assertSame(
            [
                'BYE_TEXT' => 'Bye!',
                'HELLO_WORLD' => 'Hello, World!',
                'WELCOME_TEXT' => 'Hello!',
            ],
            $this->app->make(Locale::class)->getStringsForLocale('en'),
        );
    }
}
