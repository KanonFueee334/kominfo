// webpack.mix.js
let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .css('resource/css/app.css', 'public/css')
   .sass('resources/sass/app.scss', 'public/css');