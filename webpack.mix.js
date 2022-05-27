const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

const rootPath = Mix.paths.root.bind(Mix.paths);

const tailwindPlugins = function (configFile, paths) {
    const pluginList = [tailwindcss(configFile)];

    // if (mix.inProduction()) {
    //     pluginList.push(require('@fullhuman/postcss-purgecss')({
    //         content: paths.map((path) => rootPath(path)),
    //         defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || [],
    //         whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/]
    //     }))
    // }

    return pluginList;
}

 

mix
    .js('resources/js/app.js', 'public/js/')
    .js('resources/js/admin.js', 'public/js/')
    .js('resources/js/auth.js', 'public/js/')
    .js('resources/js/editor.js', 'public/js/')

    .postCss('resources/css/app.css', 'public/css', {}, tailwindPlugins(
        'resources/css/tailwind.app.config.js',
        [  ]
    ))
    .postCss('resources/css/admin.css', 'public/css', {}, tailwindPlugins(
        'resources/css/tailwind.admin.config.js',
        [ ]
    ))
    .postCss('resources/css/auth.css', 'public/css', {}, tailwindPlugins(
        'resources/css/tailwind.auth.config.js',
        [ ]
    ));
