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

mix.js('resources/js/components/main.js', 'public/js/components/main.js')
    .js('resources/js/components/fb_market.js', 'public/js/components/fb_market.js')
    .js('resources/js/components/category_market.js', 'public/js/components/category_market.js')
    .js('resources/js/components/pay_market.js', 'public/js/components/pay_market.js')
    .js('resources/js/components/pay_detail_market.js', 'public/js/components/pay_detail_market.js')
    .js('resources/js/components/pay_online.js', 'public/js/components/pay_online.js')
    .js('resources/js/components/user.js', 'public/js/components/user.js')
    .js('resources/js/components/pay.js', 'public/js/components/pay.js')
    .js('resources/js/components/daily_sale.js', 'public/js/components/daily_sale.js')
    .sass('resources/sass/components/fb_market.scss', 'public/css/components/fb_market.css')
    .sass('node_modules/toastr/toastr.scss', 'public/css/components/toastr.min.css');

mix.version();
