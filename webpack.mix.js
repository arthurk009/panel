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
mix.setResourceRoot('../');
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.styles([
      'public/css/page/custom.css',
      'public/css/toastr/toastr.min.css',
      'public/css/sweetalert2/sweetalert2.min.css'
  ], 'public/css/all.css');

  mix.scripts([
   'public/js/jquery-validation/jquery.validate.min.js',
   'public/js/jquery-validation/localization/messages_es.min.js',
   'public/js/toastr/toastr.min.js',
   'public/js/sweetalert2/sweetalert2.all.min.js'
], 'public/js/all.js');

