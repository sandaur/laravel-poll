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

/* mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css'); */

/*Copy Fonts */
mix.copyDirectory('node_modules/gentelella/vendors/font-awesome/fonts', 'public/fonts');
mix.copyDirectory('node_modules/gentelella/vendors/bootstrap/fonts', 'public/fonts');

/*Master css */
mix.styles([
    'node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/gentelella/vendors/font-awesome/css/font-awesome.min.css',
    'node_modules/gentelella/vendors/nprogress/nprogress.css',
    'node_modules/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css',
    'node_modules/gentelella/build/css/custom.min.css',
    // pNotify
    'node_modules/gentelella/vendors/pnotify/dist/pnotify.css',
    'node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.css',
    'node_modules/gentelella/vendors/pnotify/dist/pnotify.nonblock.css',
], 'public/css/master.css');

/*Master js */
mix.scripts([
    'node_modules/gentelella/vendors/jquery/dist/jquery.min.js',
    'node_modules/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/gentelella/vendors/fastclick/lib/fastclick.js',
    'node_modules/gentelella/vendors/nprogress/nprogress.js',
    'node_modules/gentelella/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
    // pNotify
    'node_modules/gentelella/vendors/pnotify/dist/pnotify.js',
    'node_modules/gentelella/vendors/pnotify/dist/pnotify.buttons.js',
    'node_modules/gentelella/vendors/pnotify/dist/pnotify.nonblock.js',
], 'public/js/master.js');

mix.scripts([
    'resources/assets/js/custom.js',
], 'public/js/custom.min.js');


/*Assets Votaciones */
mix.copy([
    'node_modules/gentelella/vendors/iCheck/skins/flat/green.png',
    'node_modules/gentelella/vendors/iCheck/skins/flat/green@2x.png',
], 'public/css');

mix.styles([
    'node_modules/gentelella/vendors/iCheck/skins/flat/green.css',
    'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css',
    'node_modules/gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css',
], 'public/css/votations.css');

mix.scripts([
    'node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
    'node_modules/gentelella/vendors/iCheck/icheck.min.js',
    'node_modules/gentelella/vendors/moment/min/moment.min.js',
    'resources/assets/js/lang/moment-es.js', // moment locale es
    'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js',
    'node_modules/gentelella/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    'node_modules/gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js',
    'node_modules/gentelella/vendors/parsleyjs/dist/parsley.min.js',
    'resources/assets/js/lang/parsley-es.js', // parsley locale es
    'resources/assets/js/util/blockui.js',
], 'public/js/votations.js');

mix.js('resources/assets/js/votationsVue.js', 'public/js') // Controlador Vue para pagina de votaciones
