const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
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

mix.js('resources/js/app.js', 'public/js')
    .scripts('resources/js/myscript.js', 'public/js/myscript.js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    });

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
       './routes/**/*'
    ],
    watchOptions: {
      usePolling: true,
      interval: 100
    },
    open: "external",
    reloadOnRestart: true
});

