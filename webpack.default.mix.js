let mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/assets/js/app.min.js').vue()
        .js('resources/js/landing/app-landing.js', 'public/assets/js/app2.min.js').vue()
        .sass('resources/scss/scss-landing/app.scss', 'public/assets/css/app2.min.css')
        .sass('resources/scss/app.scss', 'public/assets/css/app.min.css');

// Если не нужен сервер статики, закомментировать...
// const browserSync = require("browser-sync").create();
// browserSync.init({
//     watch: true,
//     server: "./dist"
// });
