let mix = require('laravel-mix');

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

mix.js('resources/assets/js/office.js', 'public/js')
  .js('resources/assets/js/drawing_tool.js', 'public/js')
  .react('resources/assets/js/ui.js', 'public/js')
  .react('resources/assets/js/drawing.js', 'public/js')
  .sass('resources/assets/sass/office.scss', 'public/css')
  .copy('semantic/dist', 'public/semantic', false)
  .copy('resources/assets/map_path/*', 'storage/app/public/map_path', false)
  .react('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
;
