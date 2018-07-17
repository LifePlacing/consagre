let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
    .sourceMaps()
    .sass('resources/assets/sass/app.scss', 'public/css')
    .scripts([
   	'resources/assets/js/jquery.min.js',
    'resources/assets/iCheck/js/icheck.js',
    'resources/assets/bootstrapvalidator/js/bootstrapValidator.min.js'
	], 'public/js/all.js');   
