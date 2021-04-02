const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.sass('resources/scss/style.scss', 'public/css');

// Splitting React & Vue to sepeate files
mix.js('resources/js/vue.js', 'public/js').vue();
mix.js('resources/js/react.js', 'public/js').react();

// Merge all styles into one
mix.styles([
    'public/css/app.css',
    'public/css/style.css'
], 'public/css/all.css');