let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js').sourceMaps();
mix.sass('resources/assets/sass/app.scss', 'public/css'); 

/* Combine JS */

mix.combine([
'public/js/validaCPF.js',
'public/js/app.js',
], 'public/js/app.js');