const mix = require('laravel-mix');
require('laravel-mix-eslint');

mix


  // Copy HTML files
  .copy('./dist/', '../htdocs')


  // BrowserSync
  .browserSync({
    proxy: false,
    server: 'dist',
    files: [
      'dist/**/*.{css,js,html,php,jpg,jpeg,png,gif,svg}',
    ]
  })