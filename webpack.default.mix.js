let mix = require('laravel-mix');
mix.js('src/js/app.js', 'dist/assets/js').vue()
        .sass('src/scss/app.scss', 'dist/assets/css');

// Если не нужен сервер статики, закомментировать...
const browserSync = require("browser-sync").create();
browserSync.init({
    watch: true,
    server: "./dist"
});
