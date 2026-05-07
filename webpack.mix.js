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

mix.options({
    clearConsole: false
});

// Disable WebpackBar to prevent ProgressPlugin schema validation errors
mix.override((config) => {
    config.plugins = config.plugins.filter(
        plugin => plugin.constructor.name !== 'WebpackBarPlugin'
    );
});

mix.webpackConfig({
    stats: {
        children: false,
        warningsFilter: /Conflicting values for '.*NODE_ENV'/
    }
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css', {
        sassOptions: {
            quietDeps: true,
            logger: require('sass').Logger.silent
        }
    })
    .sourceMaps();
