let mix = require('laravel-mix');

mix.autoload({ 'jquery': ['window.$', 'window.jQuery', 'jQuery'] });

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

//copiar os plugins utilizados do node_modules para a pasta resources
//mix.copy('node_modules/vendor/acme.txt', 'public/js/acme.txt');

mix.styles([
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/metisMenu.min.css',
    'resources/assets/css/sb-admin-2.css',
    'resources/assets/css/custombtns.css',
    'resources/assets/css/plugins/morris.css',
    'resources/assets/css/font-awesome.min.css',
    'resources/assets/css/angular-growl.css',
    'resources/assets/css/loading-bar.min.css',
    'resources/assets/css/select2.min.css',
    'resources/assets/css/select.css',
    'resources/assets/css/ng-table.min.css',
	'resources/assets/css/textAngular.css',
    'resources/assets/css/froala_editor.min',
    'resources/assets/css/froala_style.min',

    'resources/assets/css/awesome-bootstrap-checkbox.css' //adicionado para a pesquisa dinamica com customização das checkboxes
	
], 'public/css/app.css');

mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'resources/assets/js/jquery-ui.min.js',
    'node_modules/tinymce/tinymce.js',
    'resources/assets/js/angular.min.js',
    'resources/assets/js/angular-route.min.js',
    'resources/assets/js/angular-animate.min.js',
    //'resources/assets/js/angular-sanitize.min.js',
    'resources/assets/js/angular-aria.min.js',
    'resources/assets/js/angular-messages.min.js',
    'resources/assets/js/select.js',
    'resources/assets/js/angular-growl.min.js',
    'resources/assets/js/bootstrap.min.js',

    'resources/assets/js/angular-translate.min.js',
    'resources/assets/js/angular-translate-loader-partial.min.js',
    'resources/assets/js/ui-bootstrap-tpls-2.5.0.min.js',
    'resources/assets/js/angular-file-upload.js',
    'resources/assets/js/sortable.min.js',
    'resources/assets/js/angular-drag-and-drop-lists.min.js',
    'resources/assets/js/loading-bar.min.js',
    'resources/assets/js/select2.min.js',
    'resources/assets/js/ng-table.min.js',
    'resources/assets/js/metisMenu/metisMenu.min.js',
    'resources/assets/js/sb-admin-2.js',
    'node_modules/angular-ui-tinymce/src/tinymce.js',

    //Editores
    //TextAngular
    'resources/assets/js/textAngular-rangy.min.js',
    'resources/assets/js/textAngular.min.js',
    'resources/assets/js/textAngular-sanitize.min.js',
    //Summernote
    //'resources/assets/js/angular-summernote.min.js'
    //froala

    'node_modules/angular-froala/src/angular-froala.js',
    'node_modules/froala-editor/js/froala_editor.min.js'
    //'resources/assets/js/froala-sanitize.js'
], 'public/js/app1.js');

mix.copy('node_modules/tinymce/skins', 'public/js/skins');
mix.copy('node_modules/tinymce/themes', 'public/js/themes');
mix.copy('node_modules/tinymce/plugins', 'public/js/plugins');
