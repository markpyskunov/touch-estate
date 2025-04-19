<?php

use App\Http\Controllers\SpaController;
use Illuminate\Support\Facades\Route;
use Spatie\RouteAttributes\RouteRegistrar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [SpaController::class, 'landingPage']);

// SPA Routes - all routes will be handled by the SPA except /api/*
Route::get('{any}', [SpaController::class, 'index'])->where('any', '^(?!api).*$');

// Register route attributes
(new RouteRegistrar(app()->router))
    ->useRootNamespace('App\\')
    ->useBasePath('api')
    ->useMiddleware(['api'])
    ->registerDirectory(app_path('Http/Controllers/Api'));
