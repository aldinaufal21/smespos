const mix = require('laravel-mix');

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

mix.site = (id, callback) => {
    if (!process.env.SITE || process.env.SITE === id) {
        return callback()
    }
};

mix.site('admin', () => {
  mix.js('resources/js/app.js', 'public/js/admin.js')
      .sass('resources/sass/app.scss', 'public/css/admin.css');
})

mix.site('app', () => {
    mix.js("resources/js/konsumen/app.js", "public/js/app.js");
})
