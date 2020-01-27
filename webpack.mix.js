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

mix.js('resources/js/myjqery.js', 'public/js/myjqery.js')
    .scripts('resources/js/payment.js', 'public/js/payment.js')

mix.browserSync({
    host: 'localhost',
    proxy: {
        target: "localhost",
        ws: true
    },
    browser: "google chrome",
    files: [
       './**/*.css',
       './app/**/*',
       './config/**/*',
       './resources/views/**/*.blade.php',
       './resources/views/*.blade.php',
       './resources/js/**/.js',
       './routes/**/*'
    ],
    watchOptions: {
      usePolling: true,
      interval: 100
    },
    open: "external",
    reloadOnRestart: true
});

