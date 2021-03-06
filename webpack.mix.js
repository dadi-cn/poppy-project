var mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix
    .browserSync({
        proxy : 'http://{dev.project.domain}/',
        files : [
            "public/assets/js/**/*.js",
            "public/assets/css/**/*.css",
            "modules/**/src/request/**/*.php",
            "modules/**/resources/views/**/*.blade.php"
        ]
    })
    .disableNotifications()
    .version()
