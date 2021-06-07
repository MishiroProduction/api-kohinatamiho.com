const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------n------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/* mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css') */

mix.scripts([
  'resources/plugins/jquery/jquery.min.js',
  'resources/plugins/bootstrap/js/bootstrap.bundle.js',
  'resources/plugins/jquery/jquery.min.js',
  'resources/dist/js/adminlte.min.js',
], 'public/js/app.js').styles([
  'resources/plugins/fontawesome-free/css/all.min.css',
  'resources/plugins/icons/css/open-iconic-bootstrap.css',
  'resources/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
  'resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
  'resources/plugins/jqvmap/jqvmap.min.css',
  'resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
  'resources/plugins/daterangepicker/daterangepicker.css',
  'resources/plugins/summernote/summernote-bs4.css',
  'resources/dist/css/adminlte.min.css',
], 'public/css/app.css')
