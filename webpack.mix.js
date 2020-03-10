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

mix
  .js('resources/js/app.js', 'public/js/')
  .sass('resources/style/style.sass', 'public/style/')
  .sourceMaps(true, 'source-map');

mix
  .copy('node_modules/tinymce/skins', 'public/js/skins')
  // .copy('resources/style/webfonts', 'public/style/webfonts')
  .copy('resources/img/', 'public/img/');

mix
  .browserSync({
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
  })
  .disableSuccessNotifications();
