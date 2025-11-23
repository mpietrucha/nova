let mix = require('laravel-mix')
let path = require('path')
let NovaExtension = require('laravel-nova-devtool')

mix.extend('nova', new NovaExtension())

mix.setPublicPath('dist')
    .js('resources/js/nova.js', 'js')
    .vue({ version: 3 })
    .css('resources/css/nova.css', 'css')
    .alias({
        '@': path.join(__dirname, 'resources/js/'),
        '@nova': path.resolve(__dirname, 'vendor/laravel/nova/resources/js'),
    })
    .nova('mpietrucha/nova')
    .version()
