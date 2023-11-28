<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'Index'])->name('index');
Route::get('/company/list', [MainController::class, 'CompanyList'])->name('company.list');
Route::get('/company/detail/{id}', [MainController::class, 'CompanyDetail'])->name('company.detail');
Route::get('/company/search', [MainController::class, 'CompanySearch'])->name('company.search');
Route::get('/ad/{id}', [MainController::class, 'Advertisement'])->name('advertisement');
Route::get('/policy', [MainController::class, 'PrivacyPolicy'])->name('privacy-policy');
Route::get('/terms', [MainController::class, 'TermsOfUse'])->name('terms');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
