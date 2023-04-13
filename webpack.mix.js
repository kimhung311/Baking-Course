const path = require('path')
const fs = require('fs-extra')
const mix = require('laravel-mix')
require('laravel-mix-versionhash')
// const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')

mix
    .js('resources/js/app.js', 'public/dist/js')
    .js(['resources/js/backend/app.js', 'node_modules/tinymce/tinymce.min.js'], 'public/dist/js/backend')
    .sass('resources/sass/app.scss', 'public/dist/css')
    .copyDirectory('node_modules/tinymce/plugins', 'public/js/tinymce/plugins')
    .copyDirectory('node_modules/tinymce/themes', 'public/js/tinymce/themes')
    .copyDirectory('node_modules/tinymce/icons', 'public/js/tinymce/icons')
    .copyDirectory('node_modules/tinymce/skins', 'public/js/tinymce/skins')

if (mix.inProduction()) {
    mix
        // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
        // .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
        .versionHash()
} else {
    mix.sourceMaps()
}

mix.webpackConfig({
    plugins: [
        // new BundleAnalyzerPlugin()
    ],
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '~': path.join(__dirname, './resources/js')
        }
    },
    output: {
        chunkFilename: 'dist/js/[chunkhash].js',
        path: mix.config.hmr
            ? '/'
            : path.resolve(__dirname, mix.inProduction() ? './public/build' : './public')
    }
})

mix.then(() => {
    if (mix.inProduction()) {
        process.nextTick(() => publishAseets())
    }
})

function publishAseets() {
    const publicDir = path.resolve(__dirname, './public')

    fs.removeSync(path.join(publicDir, 'dist'))
    fs.copySync(path.join(publicDir, 'build', 'dist'), path.join(publicDir, 'dist'))
    fs.removeSync(path.join(publicDir, 'build'))
}
