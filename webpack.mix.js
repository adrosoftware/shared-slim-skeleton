const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 |
 */

mix.browserSync({
    proxy: 'shared-slim-skeleton.here'
})

mix.js('./resources/assets/vue/apps/App/main.js', './js/app.js');