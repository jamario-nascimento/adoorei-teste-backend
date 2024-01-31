const mix = require('laravel-mix');

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

mix
    .js('resources/js/app.js', 'public/js')
    .js(['resources/js/required.js'], 'public/js/required.js')
    .js(['resources/js/utils.js'], 'public/js/utils.js')
    .js('resources/js/produto/listarProduto.js', 'public/js/listarProduto.js')
    .js('resources/js/produto/manterProduto.js', 'public/js/manterProduto.js')
    .js('resources/js/venda/listarVenda.js', 'public/js/listarVenda.js')
    .js('resources/js/venda/manterVenda.js', 'public/js/manterVenda.js')
    .sass('resources/sass/app.scss', 'public/css');
