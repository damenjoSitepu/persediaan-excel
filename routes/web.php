<?php

use App\Http\Controllers\Tutorial;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [Tutorial::class, 'index'])->name('tutorial');
Route::post('/import', [Tutorial::class, 'import'])->name('import');
Route::get('/export', [Tutorial::class, 'export'])->name('export');
