<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PageController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('projects/project-type', [ProjectController::class, 'types_project'])->name('types_project');
        Route::resource('projects', ProjectController::class);
        Route::get('projects/orderby/{column}/{direction}', [ProjectController::class, 'orderby'])->name('projects.orderby');
        Route::resource('types', TypeController::class)->except(['show', 'create', 'edit']);
        Route::resource('technologies', TechnologyController::class)->except(['show', 'create', 'edit']);
    });

require __DIR__.'/auth.php';
