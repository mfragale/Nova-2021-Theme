var gulp = require('gulp'),
    sass = require('gulp-sass')(require('sass')),
    sourcemaps = require('gulp-sourcemaps'),
    cleanCss = require('gulp-clean-css'),
    rename = require('gulp-rename'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer');

const { src, dest } = require("gulp");
const minify = require("gulp-minify");

function buildCss() {
    return gulp.src(['../scss/*.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([autoprefixer({
            overrideBrowserslist: [
                'Chrome >= 35',
                'Firefox >= 38',
                'Edge >= 12',
                'Explorer >= 10',
                'iOS >= 8',
                'Safari >= 8',
                'Android 2.3',
                'Android >= 4',
                'Opera >= 12']
        })]))
        // .pipe(sourcemaps.write())
        // .pipe(gulp.dest('scss/dist/'))
        .pipe(cleanCss())
        .pipe(rename({ suffix: '-min' }))
        .pipe(gulp.dest('../scss/dist/'))
}


function minifyjs() {
    return src('../js/functions.js', { allowEmpty: true })
        .pipe(minify({ noSource: true }))
        .pipe(dest('../js/dist'))
}

function watcher() {
    gulp.watch(['../scss/*.scss', '../js/*.js'],
        gulp.series(buildCss, minifyjs));
}

exports.watch = gulp.series(buildCss, watcher, minifyjs);
exports.default = gulp.series(buildCss, watcher, minifyjs);

