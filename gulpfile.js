var gulp = require('gulp'),
    concat = require('gulp-concat'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    minifyCss = require('gulp-minify-css'),
    rename = require('gulp-rename');

gulp.task('sass', function () {
    return gulp.src('./wp-content/themes/petpet/assets/sass/main.sass')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(autoprefixer())
        .pipe(minifyCss())
        .pipe(concat('main.css'))
        .pipe(rename({
            basename: 'main',
            extname: '.min.css'
        }))
        .pipe(gulp.dest('./wp-content/themes/petpet/assets/css/'));
});

gulp.task('watch', function () {
    gulp.watch('./wp-content/themes/petpet/assets/sass/**/*.sass', ['sass']);
});