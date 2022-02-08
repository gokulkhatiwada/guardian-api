const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').vue()
    .sass('resources/css/app.scss', 'public/css').options({
    processCssUrls:false
});


mix.js('resources/js/back/app.js','public/back/js')
    .sass('resources/css/back/app.scss','public/back/css').options({
    processCssUrls:false
});

mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts','public/back/webfonts');