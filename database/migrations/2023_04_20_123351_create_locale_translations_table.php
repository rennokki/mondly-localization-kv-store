<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locale_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale_string_key')->index();
            $table->string('locale', 5)->index();
            $table->text('value')->nullable();
            $table->timestamps();

            $table->index(['locale_string_key', 'locale']);

            $table->foreign('locale_string_key')
                ->references('key')
                ->on('locale_strings')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locale_translations');
    }
};
