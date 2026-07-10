<?php

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

use App\Http\Controllers\BusCompanyController;

Route::get('/', function () {
    // Redirect to bus companies for testing purposes since it's the main module
    return redirect()->route('bus-companies.index');
});

Route::resource('bus-companies', BusCompanyController::class);
Route::post('bus-companies/{id}/toggle-status', [BusCompanyController::class, 'toggleStatus'])->name('bus-companies.toggleStatus');
