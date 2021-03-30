<?php

use App\Http\Controllers\Asset\AssetController;
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

Route::get('/migrate', function() {\Illuminate\Support\Facades\Artisan::call('migrate');return "migration is done";});

Route::get('/create', function () {
    return view('create');
});

Route::get('/',[AssetController::class, 'dashboard'])
    ->middleware(['auth']);

Route::get('/dashboard',[AssetController::class, 'dashboard'])
    ->middleware(['auth'])->name('dashboard');

Route::get('/newClient',[AssetController::class, 'index'])
    ->middleware(['auth'])->name('newClient');
    
Route::get('/newClient',[AssetController::class, 'index'])
    ->middleware(['auth'])->name('newClient');
    
Route::post('/addClient',[AssetController::class, 'add'])
    ->middleware(['auth'])->name('addClient');
    
Route::post('/delete-customer',[AssetController::class, 'delete'])
    ->middleware(['auth'])->name('delete-customer');

require __DIR__.'/auth.php';
