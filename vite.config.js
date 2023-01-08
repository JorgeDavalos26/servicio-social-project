import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                
                'resources/js/admin_view_config.js',
                'resources/js/admin_view_groups.js',
                'resources/js/admin_view_solicitudes.js',
                'resources/js/environment.js',
                'resources/js/fetch_js_api.js',
                'resources/js/home_view.js',
                'resources/js/login_view.js',
                'resources/js/paginate.js',
                'resources/js/signup_view.js',
                'resources/js/solicitude_admin_view.js',
                'resources/js/solicitude_student_view.js',

                'resources/css/admin_home_view.css',
                'resources/css/application-section.css',
                'resources/css/solicitude-view.css',
                'resources/css/student-home-view.css',
                'resources/css/topbar-environment.css',
            ],
            refresh: true,
        }),
    ],
});
