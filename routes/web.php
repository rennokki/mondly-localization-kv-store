<?php

use App\Http\Controllers\LocaleStringController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('locale-string/download', [LocaleStringController::class, 'download'])->name('locale-string.download');
Route::resource('locale-string', LocaleStringController::class)->parameter('locale-string', 'locale-string:key');

Route::redirect('/', route('locale-string.index'))->name('dashboard');

require __DIR__.'/auth.php';
