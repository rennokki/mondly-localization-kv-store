<?php

namespace App\Http\Controllers;

use App\Models\LocaleString;
use App\Services\LocaleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class LocaleStringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('LocaleString/Index', [
            'localeStrings' => LocaleString::withCount('translations')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('LocaleString/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:255', 'unique:locale_strings'],
            'fallback_value' => ['required', 'string', 'max:1000'],
        ]);

        $localeString = LocaleString::create($data);

        return redirect()->route('locale-string.edit', ['locale_string' => $localeString]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LocaleString $localeString)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocaleString $localeString)
    {
        return inertia('LocaleString/Edit', [
            'localeString' => $localeString->load('translations'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocaleString $localeString)
    {
        $data = $request->validate([
            'fallback_value' => ['nullable', 'string', 'max:1000'],
            'locales' => ['nullable', 'array'],
            'locales.*' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($fallbackValue = $data['fallback_value'] ?? false) {
            $localeString->fill(['fallback_value' => $fallbackValue]);
        }

        DB::transaction(function () use ($localeString, $data) {
            $localeString->save();

            if ($locales = $data['locales'] ?? false) {
                $localeString->translations()->delete();

                foreach ($locales as $locale => $value) {
                    if ($value === '' || $value === null) {
                        continue;
                    }

                    $localeString->translations()->create([
                        'locale' => $locale,
                        'value' => $value,
                    ]);
                }
            }
        });

        return redirect()->route('locale-string.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocaleString $localeString)
    {
        //
    }

    /**
     * Download all locales as a zip file.
     */
    public function download(Request $request, LocaleService $localeService)
    {
        $zip = new ZipArchive();

        $zip->open('locales.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach (LocaleService::$locales as $locale) {
            $zip->addFromString(
                "{$locale['key']}.json",
                json_encode($localeService->getStringsForLocale($locale['key'])),
            );
        }

        $zip->close();

        return response()->download('locales.zip');
    }
}
