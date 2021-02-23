const mix = require('laravel-mix')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')

let LiveReloadPlugin = require('webpack-livereload-plugin')

mix
  .js('resources/js/app.js', 'public/js')
  .vue()
  .sass('resources/sass/app.scss', 'public/css')
  .version()

mix.webpackConfig({
  plugins: [
    new LiveReloadPlugin(),

    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: ['js/*', '!js/item.js', '!static-files*'],
    }),
  ],

  output: {
    chunkFilename: 'js/chunks/[chunkhash].js',
  },
})
