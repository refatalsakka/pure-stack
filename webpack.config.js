const dotenv = require('dotenv');
const webpack = require('webpack');
const Encore = require('@symfony/webpack-encore')

dotenv.config();

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev')
}

Encore
  // directory where compiled assets will be stored
  .setOutputPath('public/build/')
  // public path used by the web server to access the output path
  .setPublicPath('/build')
  // only needed for CDN's or subdirectory deploy
  //.setManifestKeyPrefix('build/')

  .copyFiles({
    from: './assets/icons',
    to: 'icons/[path][name].[ext]',
    pattern: /\.(png|jpg|jpeg|svg)$/
  })

  .copyFiles({
    from: './assets/shapes',
    to: 'shapes/[path][name].[ext]',
    pattern: /\.(png|jpg|jpeg|svg)$/
  })

  .copyFiles({
    from: './assets/images',
    to: 'images/[path][name].[ext]',
    pattern: /\.(png|jpg|jpeg|svg)$/
  })

  /*
   * ENTRY CONFIG
   *
   * Each entry will result in one JavaScript file (e.g. app.js)
   * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
   */
  .addEntry('app', './assets/app.js')
  .addEntry('home', './assets/pages/home/home.js')
  .addEntry('imprint', './assets/pages/imprint/imprint.js')
  .addEntry('privacy-policy', './assets/pages/privacy-policy/privacy-policy.js')

  // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
  .splitEntryChunks()

  // will require an extra script tag for runtime.js
  // but, you probably want this, unless you're building a single-page app
  .enableSingleRuntimeChunk()

  /*
   * FEATURE CONFIG
   *
   * Enable & configure other features below. For a full
   * list of features, see:
   * https://symfony.com/doc/current/frontend.html#adding-more-features
   */
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  // enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

  // configure Babel
  // .configureBabel((config) => {
  //     config.plugins.push('@babel/a-babel-plugin');
  // })

  // enables and configure @babel/preset-env polyfills
  // .configureBabelPresetEnv((config) => {
  //     config.useBuiltIns = 'usage';
  //     config.corejs = '3.23';
  // })

  // enables Sass/SCSS support
  .enableSassLoader(function () {}, {
    resolveUrlLoader: true // Enable resolve-url-loader
  })

  // Add this plugin to expose your environment variables
  .addPlugin(new webpack.DefinePlugin({
    'process.env': {
      'DOMAIN_NAME': JSON.stringify(process.env.DOMAIN_NAME),
      'MATOMO_DOMAIN_NAME': JSON.stringify(process.env.MATOMO_DOMAIN_NAME),
    }
  }))
// other configurations...
console.log( JSON.stringify(process.env));

module.exports = Encore.getWebpackConfig()
