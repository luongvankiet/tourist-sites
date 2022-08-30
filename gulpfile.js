const { src, dest, watch, series } = require('gulp')
const sass = require('gulp-sass')(require('sass'))

function buildStyles() {
    return src('./resources/assets/sass/**/*.scss')
        .pipe(sass())
        .pipe(dest('./resources/assets/css'))
}

function watchTask() {
    watch(['./resources/assets/sass/**/*.scss'], buildStyles)
}

exports.default = series(buildStyles, watchTask)
