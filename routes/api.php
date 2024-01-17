<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/followed/{id}', [ApiController::class, 'Followed'])->name('api.followed');
Route::post('/unfollowed/{id}', [ApiController::class, 'Unfollowed'])->name('api.unfollowed');
Route::middleware('auth:api')->group(function () {
    Route::post('/company_name_edit', [ApiController::class, 'companyNameEdit'])->name('api.company_name_edit');
    Route::post('/company_industry_edit', [ApiController::class, 'companyIndustryEdit'])->name('api.company_industry_edit');
    Route::post('/company_logo_edit', [ApiController::class, 'companyLogoEdit'])->name('api.company_logo_edit');
    Route::post('/company_img_edit', [ApiController::class, 'companyImgEdit'])->name('api.company_img_edit');
    Route::post('/business_detail_edit', [ApiController::class, 'businessDetailEdit'])->name('api.business_detail_edit');
    Route::post('/pr_edit', [ApiController::class, 'prEdit'])->name('api.pr_edit');
    Route::get('/occupation_item_add', [ApiController::class, 'occupationItemAdd'])->name('api.occupation_item_add');
    Route::delete('/occupation_item_delete/{id}', [ApiController::class, 'occupationItemDelete'])->name('api.occupation_item_delete');
    Route::post('/occupation_edit', [ApiController::class, 'occupationEdit'])->name('api.occupation_edit');
    Route::post('/job_detail_edit', [ApiController::class, 'jobDetailEdit'])->name('api.job_detail_edit');
});
