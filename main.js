/**
 * Main Tasks JS
 */
var gulp      = require('gulp'); 
var concatCss = require('gulp-concat-css');
var minifyCSS = require('gulp-minify-css');

gulp.task('assets', function () {
 
    gulp.src('templates/assets/*/*.css')
        .pipe(concatCss('all.css'))
        .pipe(minifyCSS())
        .pipe(gulp.dest('web/public'));
});
 
gulp.task('default', ['assets']);