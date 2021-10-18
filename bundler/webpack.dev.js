const path = require('path');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const MiniCSSExtractPlugin = require('mini-css-extract-plugin')
const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const config = require('./config.js')
const webpack = require('webpack');
const AssetsPlugin = require("assets-webpack-plugin");

module.exports = (env) => {

  return {
    entry: {

      index: "./assets/src/js/index.js",
      news: "./assets/src/js/news.js",
      print: "./assets/src/js/print.js",
      about: "./assets/src/js/about.js",
      team: "./assets/src/js/team.js",
      news_item: "./assets/src/js/news_item.js",
      team_member: "./assets/src/js/team_member.js",
      gallery: "./assets/src/js/gallery.js",
    },
    output: {
      filename: "[name].js",
      chunkFilename: "[name]/[name].js",
      path: path.resolve(__dirname, "../assets/dist")
    },
    optimization: {
      splitChunks: {

        cacheGroups: {
          common: {
            name: "common",
            filename: "script/[name]/[name].[chunkhash:8].js",
            test: /[\\/]node_modules[\\/]/,
            chunks: "all",
            //  minSize: 0
          }
        }
      }
    },
    plugins: [
      new BrowserSyncPlugin({
        files: '**/*',
        host: '127.0.0.1',
        injectChanges: false,
        notify: false,
        open: 'external',
        port: 80,
        proxy: config.datas.localPath
      }),
      new UglifyJSPlugin({
        sourceMap: env.sourcemaps ? true : false
      }),
      new MiniCSSExtractPlugin({
        filename: "css/[name].[contenthash:8].css"
      }),
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery'
      }),
      new AssetsPlugin({
        removeFullPathAutoPrefix: true,
        entrypoints: true,
        includeFilesWithoutChunk: false,
        prettyPrint: true,
        path: path.join(__dirname, "../assets/dist/paths"),
        filename: "assets.json"
      })
    ],
    externals: {
      jquery: 'jQuery'
    },
    module: {
      rules: [
        // JAVASCRIPT
        {
          test: /\.js$/,
          exclude: /(node_modules|bower_components)/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env']
            }
          }
        },
        // SASS
        {
          test: /\.(sass|scss|css)$/i,

          use: [
            // fallback to style-loader in development
            process.env.NODE_ENV !== "production" ?
            "style-loader" :
            MiniCSSExtractPlugin.loader,
            {
              loader: MiniCSSExtractPlugin.loader,
              options: {
                esModule: false
              }
            },

            "css-loader",
            "postcss-loader",
            "sass-loader"
          ]
        },
        {
          test: /\.(woff|woff2|eot|ttf|otf)$/i,
          use: [{
            loader: "file-loader",
            options: {
              name: "[name].[ext]",
              outputPath: "fonts",

            }
          }]
        },
        {
          test: /\.(svg|png)$/,
          type: "asset/inline"
        },
        {
          test: /\.gif$/i,
          loader: "file-loader",
          options: {
            name: "[name].[contenthash].[ext]",
            outputPath: "img"
          }
        },
        {
          test: /\.jpg$/,
          type: "asset/resource",
          generator: {
            filename: "img/[name][ext]"
          }
        },
      ]
    },

    mode: 'development',
    devtool: env.sourcemaps ? 'source-map' : false
  };
};