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

mix.webpackConfig(config => {
    const webpack = require('webpack');

    if (Array.isArray(config.plugins)) {
        config.plugins = config.plugins.filter(
            plugin => !(plugin && plugin.constructor && plugin.constructor.name === 'WebpackBarPlugin')
        );
    }

    config.plugins = config.plugins || [];
    config.plugins.push(new webpack.ProgressPlugin({ activeModules: true }));
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
