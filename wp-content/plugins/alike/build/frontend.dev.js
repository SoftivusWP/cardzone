/* eslint-disable */
const autoprefixer = require('autoprefixer');
const webpack = require('webpack');
const webpackMerge = require('webpack-merge');
const notify = require('webpack-notifier');
const WebpackMd5Hash = require('webpack-md5-hash');
const AssetsPlugin = require('assets-webpack-plugin');
const OfflinePlugin = require('offline-plugin');
const SWPrecacheWebpackPlugin = require('sw-precache-webpack-plugin');
const CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');
const WatchMissingNodeModulesPlugin = require('react-dev-utils/WatchMissingNodeModulesPlugin');
const ChunkManifestPlugin = require('chunk-manifest-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const paths = require('./paths');
const commonConfig = require('./base');
const prefix = 'alike';

const ExtractFrontCss = new ExtractTextPlugin(`../css/${prefix}-bundle-front.css`);
const ExtractFrontLess = new ExtractTextPlugin(`../css/${prefix}-bundle-front-two.css`);

const fileNames = ['frontend'];
const entries = {};
fileNames.forEach((fileName) => {
  entries[`${prefix}_${fileName}`] =  `${paths.appSrc}/frontend/${fileName}.js`;
});
module.exports = function(env) {
  return webpackMerge(commonConfig(), {
    name: prefix,
    devtool: 'cheap-module-eval-source-map',
    entry: entries,
    module: {
      rules:[
        {
          test: /\.css$/,
          use: ExtractFrontCss.extract({
            fallback: 'style-loader',
            use: 'css-loader'
          }),
        },
        {
          test: /\.less$/,
          use: ExtractFrontLess.extract({
            fallback: 'style-loader',
            use: [
              'css-loader?modules&importLoaders=2&sourceMap&localIdentName=[local]___[hash:base64:5]',
              'less-loader?outputStyle=expanded&sourceMap',
            ]
          }),
        },
      ],
    },
    output: {
      path: paths.appDest,
      filename: '[name].js',
      chunkFilename: '[name].chunk.js',
    },
    plugins: [
      new webpack.DefinePlugin({
        __DEV__: JSON.stringify('dev')
      }),
      ExtractFrontCss,
      ExtractFrontLess,
      // new webpack.optimize.CommonsChunkPlugin({
      //   name: 'vendor',
      //   filename: 'scwp_forntend_vendor.js',
      //   minChunks: function (module) {
      //      // this assumes your vendor imports exist in the node_modules directory
      //      return module.context && module.context.indexOf('node_modules') !== -1;
      //   },
      // }),
      new CaseSensitivePathsPlugin(),
      new WatchMissingNodeModulesPlugin(paths.appNodeModules),
      new AssetsPlugin({ fullPath: false, prettyPrint: true, filename: './resource/frontend-assets.json'}),
      new notify({ title: 'Webpack', sound: 'Glass' }),
    ]
  });
}
