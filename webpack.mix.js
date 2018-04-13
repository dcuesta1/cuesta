let mix = require('laravel-mix');

mix.js(['resources/assets/js/main.js', 'resources/assets/js/contactForm.js'], 'public/js/main.js')
   .sass('resources/assets/sass/main.scss', 'public/css')
	.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/vendor/bootstrap/css/')
	.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/vendor/bootstrap/js/')
	.copy('node_modules/jquery/dist/jquery.min.js', 'public/vendor/jquery')
    .copy('node_modules/jquery-validation/dist/jquery.validate.min.js', 'public/vendor/jquery-validate/jquery.validate.min.js')
	.copy('node_modules/jquery.easing/jquery.easing.min.js', 'public/vendor/jquery-easing/jquery.easing.min.js')
	.copy('node_modules/font-awesome/css/font-awesome.min.css', 'public/vendor/font-awesome/css/')
	.copyDirectory('node_modules/font-awesome/fonts', 'public/vendor/font-awesome/fonts/')
    //.copy('node_modules/simple-line-icons/css/simple-line-icons.css', 'public/vendor/simple-line-icons/css/')
    //.copyDirectory('node_modules/simple-line-icons/fonts', 'public/vendor/simple-line-icons/fonts/')
    .copy('resources/assets/img', 'public/images', true);

//TODO: make production mix

