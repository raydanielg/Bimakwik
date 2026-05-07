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

process.env.NODE_ENV = 'test';

mix.webpackConfig((webpack, config) => {
    if (!config || !config.module || !Array.isArray(config.module.rules)) {
        return {};
    }

    for (const rule of config.module.rules) {
        const ruleUses = rule && rule.use;
        const uses = Array.isArray(ruleUses) ? ruleUses : [];

        for (const use of uses) {
            if (!use || typeof use !== 'object') continue;

            if (typeof use.loader === 'string' && use.loader.includes('sass-loader')) {
                use.options = use.options || {};
                use.options.sassOptions = use.options.sassOptions || {};
                use.options.sassOptions.quietDeps = true;
            }
        }
    }

    return {};
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
