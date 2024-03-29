import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        manifest: true,
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
                appStyles: 'resources/css/app.css',
                firebase: 'resources/js/firebase.js',
                common: 'resources/js/common.js',
                commonStyles: 'resources/css/common.css',
                dashboard: 'resources/js/dashboard/dashboard.js',
                dashboardStyles: 'resources/css/dashboard/dashboard.css',
                adminSetting: 'resources/js/dashboard/admin-setting.js',
                adminDistribution: 'resources/js/dashboard/distribution.js',
                adminUserList: 'resources/js/dashboard/user-list.js',
                adminUserDetail: 'resources/js/dashboard/user-detail.js',
                adminCompanyList: 'resources/js/dashboard/company-list.js',
                adminCompanyDetail: 'resources/js/dashboard/company-detail.js',
                adminCompanyIssue: 'resources/js/dashboard/company-issue.js',
                corporate: 'resources/js/corporate/corporate.js',
                corporateStyles: 'resources/css/dashboard/corporate.css',
                corporateEdit: 'resources/js/corporate/corporate-edit.js',
                corporateEditStyles: 'resources/css/dashboard/corporate-edit.css',
                corporateOneWordPr: 'resources/js/corporate/corporate-one-word.js',
                followers: 'resources/js/corporate/followers.js',
                visitors: 'resources/js/corporate/visitors.js',
                student: 'resources/js/student/student.js',
                studentStyles: 'resources/css/dashboard/student.css',
                admission: 'resources/js/student/admission.js',
                mainStyles: 'resources/css/main.css',
                index: 'resources/js/index.js',
                companyList: 'resources/js/company-list.js',
                companyDetail: 'resources/js/company-detail.js',
                follow: 'resources/js/follow.js',
                visitor: 'resources/js/visit.js',
                qrIssue: 'resources/js/qr-issue.js',
                qrIssueStyles: 'resources/css/qr-issue.css',
                qrIssueSmallStyles: 'resources/css/qr-issue-small.css',
                adminAdmission: 'resources/js/dashboard/admin-admission.js',
                qrRead: 'resources/js/student/qr-read.js',
            },
        },
    }
});
