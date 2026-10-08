'use strict';

const { src, dest, watch, series, parallel } = require('gulp');
const sassCompiler = require('sass');
const gulpSass = require('gulp-sass')(sassCompiler);
const cleanCSS = require('gulp-clean-css');
const terser = require('gulp-terser');
const browserSync = require('browser-sync').create();
const { spawn } = require('node:child_process');

let phpServer;
let browserSyncActive = false;

function styles() {
  return src('src/scss/app.scss')
    .pipe(gulpSass().on('error', gulpSass.logError))
    .pipe(cleanCSS())
    .pipe(dest('dist/css'))
    .on('end', () => {
      if (browserSyncActive) {
        browserSync.reload();
      }
    });
}

function scripts() {
  return src('src/js/app.js')
    .pipe(terser())
    .pipe(dest('dist/js'))
    .on('end', () => {
      if (browserSyncActive) {
        browserSync.reload();
      }
    });
}

function copyBootstrapCSS() {
  return src('node_modules/bootstrap/dist/css/bootstrap.min.css')
    .pipe(dest('dist/vendor/bootstrap'));
}

function copyBootstrapJS() {
  return src('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')
    .pipe(dest('dist/vendor/bootstrap'));
}

const copyBootstrap = parallel(copyBootstrapCSS, copyBootstrapJS);

function startDev(done) {
  const phpBinary = process.env.PHP_BINARY || 'php';
  phpServer = spawn(phpBinary, ['-S', '127.0.0.1:8000'], { stdio: 'inherit' });
  phpServer.on('error', done);

  browserSync.init({
    proxy: '127.0.0.1:8000',
    notify: false,
    open: false
  }, (error) => {
    browserSyncActive = !error;
    done(error);
  });
}

function watchFiles() {
  watch('src/scss/**/*.scss', styles);
  watch('src/js/**/*.js', scripts);
  watch(['index.php', 'includes/**/*.php', 'sections/**/*.php'], (done) => {
    if (browserSyncActive) {
      browserSync.reload();
    }
    done();
  });
}

exports.build = parallel(styles, scripts, copyBootstrap);
exports.watch = series(exports.build, watchFiles);
exports.dev = series(exports.build, startDev, watchFiles);