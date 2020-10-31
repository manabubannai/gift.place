const mix = require('laravel-mix')
// const CopyWebpackPlugin = require('copy-webpack-plugin')
const CompressionPlugin = require("compression-webpack-plugin");

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

mix.webpackConfig({
  module: {
    rules: [
      {
        enforce: 'pre',
        exclude: /node_modules/,
        loader: 'eslint-loader',
        test: /\.(js|vue)?$/
      },
    ]
  },
  plugins: [
    new CompressionPlugin({
      test: /\.(css)|(js)$/,
      compressionOptions: {
        level: 9
      }
    }),
    // new CopyWebpackPlugin(
    //   [
    //     {
    //       from: "./resources/assets/images/",
    //       to:   "images/"
    //     }
    //   ]
    // )
  ]
})

mix.js('resources/assets/js/user/app.js', 'public/js')
    .js('resources/assets/js/user/stripe.js', 'public/js')
    .sass('resources/assets/sass/user/app.scss', 'public/css')
