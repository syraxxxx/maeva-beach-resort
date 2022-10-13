const path = require('path')
const merge = require('webpack-merge')

const env = require('./utils/env')
const config = require('../config/app')


module.exports = merge(
    {
        /**
         * Project paths.
         *
         * @type {Object}
         */
        paths: {
            root: path.resolve(__dirname, '../'),
            public: path.resolve(__dirname, '../public'),
            sass: path.resolve(__dirname, '../resources/assets/sass'),
            fonts: path.resolve(__dirname, '../resources/assets/fonts'),
            images: path.resolve(__dirname, '../resources/assets/images'),
            javascript: path.resolve(__dirname, '../resources/assets/js'),
            fonts: path.resolve(__dirname, '../resources/assets/fonts'),
            relative: '../',
            external: /node_modules|bower_components/,
            vendors: path.resolve(__dirname, '../public/vendors'),
            jsVendors: path.resolve(__dirname, '../resources/assets/vendors'),
            utils: path.resolve(__dirname, '../resources/assets/utils'),
            nodeModules: path.resolve(__dirname, '../node_modules'),

            themeOptions: {
                public: path.resolve(__dirname, '../inc/admin/theme_options/assets'),
                sass: path.resolve(__dirname, '../inc/admin/theme_options/assets_src/sass'),
            }
        },

        /**
         * Collection of application front-end assets.
         *
         * @type {Array}
         */
        assets: [],

        /**
         * List of filename schemas for different
         * application assets.
         *
         * @type {Object}
         */
        outputs: {
            css: {
                filename: env('FILENAME_CSS', 'css/[name].css')
            },

            font: {
                filename: env('FILENAME_FONT', 'fonts/[name].[ext]')
            },

            image: {
                filename: env('FILENAME_IMAGE', 'images/[path][name].[ext]')
            },

            javascript: {
                filename: env('FILENAME_JAVASCRIPT', 'js/[name].js')
            },

            external: {
                image: {
                    filename: env('FILENAME_EXTERNAL_IMAGE', 'images/[name].[ext]')
                },
                font: {
                    filename: env('FILENAME_EXTERNAL_FONT', 'fonts/[name].[ext]')
                }
            },
            cssVendors: {
                filename: env('FILENAME_CSS', 'vendors/[name].css')
            },
            jsVendors: {
                filename: env('FILENAME_JAVASCRIPT', 'vendors/[name].js')
            }
        },

        /**
         * List of libraries which will be provided
         * within application scripts as external.
         *
         * @type {Object}
         */
        externals: {
            jquery: 'jQuery',
        },

        /**
         * List of custom modules resolving.
         *
         * @type {Object}
         */
        resolve: {
            alias: {
                'vue$': 'vue/dist/vue.esm.js',
                'utils': path.resolve(__dirname, '../resources/assets/utils')
            }
        },

        /**
         * Settings of other build features.
         *
         * @type {Object}
         */
        settings: {
            sourceMaps: env('SOURCEMAPS', true),
            styleLint: {
                context: 'resources/assets'
            },
            autoprefixer: {
                browsers: ['last 2 versions', '> 1%'],
            },
            browserSync: {
                host: env('BROWSERSYNC_HOST', 'localhost'),
                port: env('BROWSERSYNC_PORT', 3000),
                proxy: env('BROWSERSYNC_PROXY', 'http://hotel.loc/'),
                open: env('BROWSERSYNC_OPEN', false),
                reloadDelay: env('BROWSERSYNC_DELAY', 500),
                files: [
                    '*.php',
                    'app/**/*.php',
                    'resources/templates/**/*.php',
                    'resources/assets/js/**/*.js',
                    // 'resources/assets/sass/**/*.{sass,scss}',
                    'resources/assets/images/**/*.{jpg,jpeg,png,gif,svg}',
                    'resources/assets/fonts/**/*.{eot,ttf,woff,woff2,svg}'
                ]
            }
        }
    }, config)
