const mix = require('laravel-mix');

mix.setPublicPath('./webroot')
  .js('resources/js/app.js', 'webroot/js')
  .combine([
    'resources/css/base.css',
    'resources/css/foundation-icons.css',
    'resources/css/style.css',
  ], 'webroot/css/main.css')
  .copyDirectory('resources/css/foundation-icons', 'webroot/css/foundation-icons')
  .version();
