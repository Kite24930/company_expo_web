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
    Route::post('/target_edit', [ApiController::class, 'targetEdit'])->name('api.target_edit');
    Route::post('/head_office_address_edit', [ApiController::class, 'headOfficeAddressEdit'])->name('api.head_office_address_edit');
    Route::post('/established_at_edit', [ApiController::class, 'establishedAtEdit'])->name('api.established_at_edit');
    Route::post('/capital_edit', [ApiController::class, 'capitalEdit'])->name('api.capital_edit');
    Route::post('/sales_edit', [ApiController::class, 'salesEdit'])->name('api.sales_edit');
    Route::post('/employees_edit', [ApiController::class, 'employeesEdit'])->name('api.employees_edit');
    Route::post('/mie_univ_ob_og_edit', [ApiController::class, 'mieUnivObOgEdit'])->name('api.mie_univ_ob_og_edit');
    Route::post('/planned_number_edit', [ApiController::class, 'plannedNumberEdit'])->name('api.planned_number_edit');
    Route::post('/branch_insert_head_office', [ApiController::class, 'branchInsertHeadOffice'])->name('api.branch_insert_head_office');
    Route::delete('/branch_office_delete/{id}/{company_id}', [ApiController::class, 'branchOfficeDelete'])->name('api.branch_office_delete');
    Route::get('/branch_office_add/{target}', [ApiController::class, 'branchOfficeAdd'])->name('api.branch_office_add');
    Route::post('/branch_office_edit', [ApiController::class, 'branchOfficeEdit'])->name('api.branch_office_edit');
    Route::post('/recruit_in_charge_edit', [ApiController::class, 'recruitInChargeEdit'])->name('api.recruit_in_charge_edit');
    Route::post('/url_edit', [ApiController::class, 'urlEdit'])->name('api.url_edit');
    Route::post('/follow/company', [ApiController::class, 'follow'])->name('api.follow');
    Route::post('/follow/disclosure', [ApiController::class, 'followDisclosure'])->name('api.follow.disclosure');
    Route::post('/visit/disclosure', [ApiController::class, 'visitDisclosure'])->name('api.visit.disclosure');
});
