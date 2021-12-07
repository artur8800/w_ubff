
const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const MiniCSSExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const config = require('./config.js');
const webpack = require('webpack');
const AssetsPlugin = require('assets-webpack-plugin');
const {
  CleanWebpackPlugin,
} = require('clean-webpack-plugin');

module.exports = (env) => {
  return {
    entry: {

      index: './assets/src/js/index.js',
      news: './assets/src/js/news.js',
      print: './assets/src/js/print.js',
      about: './assets/src/js/about.js',
      team: './assets/src/js/team.js',
      news_item: './assets/src/js/news_item.js',
      team_member: './assets/src/js/team_member.js',
      gallery: './assets/src/js/gallery.js',
      ublock_section: './assets/src/js/blocks/ublock-section.js',
      ublock_media_text: './assets/src/js/blocks/ublock-media-text.js',
      ublock_column: './assets/src/js/blocks/ublock-column.js'
    },
    output: {

      filename: (pathData) => {
        return /ublock/.test(pathData.chunk.name) ? 'js/blocks/[name]/[name].js' : 'js/[name].js';
      },
      path: path.resolve(__dirname, '../assets/dist/'),
    },
    optimization: {
      splitChunks: {
        cacheGroups: {
          common: {
            name: 'common',
            filename: 'js/[name]/[name].[chunkhash:8].js',
            test: /[\\/]node_modules[\\/]|\/blocks\//,
            chunks: 'all',
          },
        },
      },
    },
    plugins: [
      new CleanWebpackPlugin({
        cleanStaleWebpackAssets: false,
      }),
      new BrowserSyncPlugin({
        files: '**/*',
        host: '127.0.0.1',
        injectChanges: false,
        notify: false,
        open: 'external',
        port: 80,
        proxy: config.datas.localPath,
      }),
      new UglifyJSPlugin({
        sourceMap: env.sourcemaps ? true : false,
      }),
      new MiniCSSExtractPlugin({
        filename: (pathData) => {
          return /ublock/.test(pathData.chunk.name) ? 'js/blocks/[name]/editor.css' : 'css/[name].[contenthash:8].css';
        },
      }),
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
      }),
      new AssetsPlugin({
        removeFullPathAutoPrefix: true,
        entrypoints: true,
        includeFilesWithoutChunk: false,
        prettyPrint: true,
        path: path.join(__dirname, '../assets/dist/paths'),
        filename: 'assets.json',
      }),
    ],

    module: {
      rules: [
        // JAVASCRIPT
        {
          test: /\.js$/,
          exclude: /(node_modules|bower_components)/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env'],
            },
          },
        },
        // SASS
        {
          test: /\.(sass|scss|css)$/i,

          use: [
            // fallback to style-loader in development
            process.env.NODE_ENV !== 'production'
              ? 'style-loader'
              : MiniCSSExtractPlugin.loader,
            {
              loader: MiniCSSExtractPlugin.loader,
              options: {
                esModule: false,
              },
            },

            'css-loader',
            'postcss-loader',
            'sass-loader',
          ],
        },
        {
          test: /\.(woff|woff2|eot|ttf|otf)$/i,
          use: [{
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: './fonts',
              publicPath: '../fonts',
            },
          }],
        },
        {
          test: /\.(svg|png)$/,
          type: 'asset/inline',
        },
        {
          test: /\.gif$/i,
          loader: 'file-loader',
          options: {
            name: '[name].[contenthash].[ext]',
            outputPath: 'img',
          },
        },
        {
          test: /\.jpg$/,
          type: 'asset/resource',
          generator: {
            filename: 'img/[name][ext]',
          },
        },
      ],
    },

    mode: 'development',
    devtool: env.sourcemaps ? 'source-map' : false,
  };
};
