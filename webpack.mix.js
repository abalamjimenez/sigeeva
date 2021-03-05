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

mix.sass('resources/sass/bootstrap4.scss', 'public/css');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/usuarios/index.js', 'public/js/usuarios').version();
mix.js('resources/js/usuarios/editarmiperfil.js', 'public/js/usuarios').version();

mix.js('resources/js/solicitudes/reinscripcion.js', 'public/js/solicitudes').version();

mix.js('resources/js/personas/create.js', 'public/js/personas').version();

mix.js('resources/js/alumnos/create.js', 'public/js/alumnos').version();
mix.js('resources/js/alumnos/editardatos.js', 'public/js/alumnos').version();
mix.js('resources/js/alumnos/editartutor.js', 'public/js/alumnos').version();

mix.js('resources/js/administrativos/editardatos.js', 'public/js/administrativos').version();

mix.js('resources/js/docentes/editardatos.js', 'public/js/docentes').version();

mix.js('resources/js/serviciosescolares/planes/create.js', 'public/js/serviciosescolares/planes').version();
mix.js('resources/js/serviciosescolares/planes/modalidades/create.js', 'public/js/serviciosescolares/planes/modalidades').version();

mix.js('resources/js/grupos/index.js', 'public/js/grupos').version();
mix.js('resources/js/controlescolar/grupos/index.js', 'public/js/controlescolar/grupos').version();

mix.js('resources/js/historicos/grupo/index.js', 'public/js/historicos/grupo').version();


mix.js('resources/js/groups/index.js', 'public/js/groups').version();

mix.js('resources/js/alumnos/historial.js', 'public/js/alumnos').version();

//if (mix.inProduction()) {
//    mix.version();
//}
