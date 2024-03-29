<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

if (app()->isLocal()) {
    Route::get('/forgot-password-email', function () {
        $user = new User([
            'email' => 'user@example.com',
        ]);
        return (new App\Notifications\ResetPasswordNotification('token'))->toMail($user);
    });
}

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/first-login', [ProfileController::class, 'firstLogin'])->name('profile.first-login');
    Route::put('/profile/first-login', [ProfileController::class, 'firstLoginUpdate'])->name('profile.first-login-update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

    Route::group(['permission:student'], function () {
        Route::get('/student/initial-setting', [StudentController::class, 'StudentInitialSetting'])->name('student.initial-setting');
        Route::post('/student/initial-setting', [StudentController::class, 'StudentInitialSettingPost'])->name('student.initial-setting.post');
        Route::get('/student/account', [StudentController::class, 'StudentAccount'])->name('student.show');
        Route::get('/student/account/edit', [StudentController::class, 'StudentAccountEdit'])->name('student.edit');
        Route::post('/student/account/edit', [StudentController::class, 'StudentAccountPost'])->name('student.store');
        Route::get('/student/followed', [StudentController::class, 'StudentFollowed'])->name('student.followed');
        Route::get('/student/visited', [StudentController::class, 'StudentVisited'])->name('student.visited');
        Route::get('/student/qr-read', [StudentController::class, 'StudentQrRead'])->name('student.qr-read');
        Route::post('/student/visiting', [StudentController::class, 'StudentQrPost'])->name('student.visiting');
        Route::get('/student/admission', [StudentController::class, 'StudentAdmission'])->name('student.admission');
    });

    Route::group(['permission:company'], function () {
        Route::get('/corporate', [CorporateController::class, 'CorporateAccount'])->name('company.show');
        Route::get('/corporate/edit', [CorporateController::class, 'CorporateAccountEdit'])->name('company.edit');
        Route::post('/corporate/edit', [CorporateController::class, 'CorporateAccountEditPost'])->name('company.store');
        Route::get('/corporate/one_word_pr', [CorporateController::class, 'CorporateOneWordPr'])->name('company.one_word_pr');
        Route::post('/corporate/one_word_pr', [CorporateController::class, 'CorporateOneWordPrPost'])->name('company.one_word_pr.post');
        Route::delete('/corporate/one_word_pr', [CorporateController::class, 'CorporateOneWordPrDelete'])->name('company.one_word_pr.delete');
        Route::get('/corporate/followers', [CorporateController::class, 'CorporateFollowers'])->name('company.followers');
        Route::get('/corporate/visitors', [CorporateController::class, 'CorporateVisitors'])->name('company.visitors');
        Route::get('/corporate/advertisement', [CorporateController::class, 'CorporateAdvertisement'])->name('company.advertisement');
        Route::post('/corporate/advertisement', [CorporateController::class, 'CorporateAdvertisementPost'])->name('company.advertisement.post');
    });

    Route::group(['permission:admin'], function () {
        Route::get('/admin/setting', [AdminController::class, 'AdminSetting'])->name('admin.setting');
        Route::post('/admin/setting', [AdminController::class, 'AdminSettingPost'])->name('admin.setting.post');
        Route::get('/admin/distribution', [AdminController::class, 'AdminDistribution'])->name('admin.distribution');
        Route::post('/admin/distribution/date/post', [AdminController::class, 'AdminDistributionPost'])->name('admin.date.post');
        Route::delete('/admin/distribution/date/delete/{id}', [AdminController::class, 'AdminDistributionDelete'])->name('admin.date.delete');
        Route::post('/admin/distribution/period/post', [AdminController::class, 'AdminDistributionPeriodPost'])->name('admin.period.post');
        Route::delete('admin/distribution/period/delete/{id}', [AdminController::class, 'AdminDistributionPeriodDelete'])->name('admin.period.delete');
        Route::post('/admin/distribution/booth/post', [AdminController::class, 'AdminDistributionBoothPost'])->name('admin.booth.post');
        Route::post('/admin/distribution/layout/post', [AdminController::class, 'AdminDistributionLayoutPost'])->name('admin.layout.post');
        Route::get('/admin/advertisement/setting', [AdminController::class, 'AdminAdvertisementSetting'])->name('admin.advertisement.setting');
        Route::post('/admin/advertisement/setting', [AdminController::class, 'AdminAdvertisementSettingPost'])->name('admin.advertisement.setting.post');
        Route::get('/admin/advertisement/company/{id}', [AdminController::class, 'AdminAdvertisementEdit'])->name('admin.advertisement.edit');
        Route::post('/admin/advertisement/company/{id}', [AdminController::class, 'AdminAdvertisementEditPost'])->name('admin.advertisement.edit.post');
        Route::get('/admin/user/list', [AdminController::class, 'AdminUserList'])->name('admin.user.list');
        Route::get('/admin/user/list/{id}', [AdminController::class, 'AdminUserListDetail'])->name('admin.user.list.detail');
        Route::post('/admin/user/list/{id}', [AdminController::class, 'AdminUserListPost'])->name('admin.user.list.post');
        Route::get('/admin/company_issue', [AdminController::class, 'AdminCompanyIssue'])->name('admin.company.issue');
        Route::post('/admin/company_issue', [AdminController::class, 'AdminCompanyIssuePost'])->name('admin.company.issue.post');
        Route::get('/admin/company/list', [AdminController::class, 'AdminCompanyList'])->name('admin.company.list');
        Route::post('/admin/company/layout/post/{id}', [AdminController::class, 'AdminCompanyLayoutPost'])->name('admin.company.layout.post');
        Route::get('/admin/company/edit/{user_id}', [AdminController::class, 'AdminCompanyEdit'])->name('admin.company.edit');
        Route::post('/admin/company/edit/{user_id}', [AdminController::class, 'AdminCompanyEditPost'])->name('admin.company.edit.post');
        Route::get('/admin/qr/issue', [AdminController::class, 'AdminQrIssue'])->name('admin.qr.issue');
        Route::get('/admin/qr/issue/small', [AdminController::class, 'AdminQrIssueSmall'])->name('admin.qr.issue.small');
        Route::get('/admin/booth_number/issues', [AdminController::class, 'AdminBoothNumberIssues'])->name('admin.booth_number.issues');
        Route::get('/admin/admission', [AdminController::class, 'AdminAdmission'])->name('admin.admission');
        Route::post('/admin/admission', [AdminController::class, 'AdminAdmissionPost'])->name('admin.admission');
    });
});
