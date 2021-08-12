let mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/assets/js').vue()
        .sass('resources/scss/scss-landing/app.scss', 'public/assets/css/app2.css')
        .sass('resources/scss/app.scss', 'public/assets/css');

// Если не нужен сервер статики, закомментировать...
// const browserSync = require("browser-sync").create();
// browserSync.init({
//     watch: true,
//     server: "./dist"
// });
