let mix = require('laravel-mix')

let LiveReloadPlugin = require('webpack-livereload-plugin')

mix
  .js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .version()

mix.webpackConfig({
  plugins: [new LiveReloadPlugin()],
})
