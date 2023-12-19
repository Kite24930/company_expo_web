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
            },
        },
    }
});
