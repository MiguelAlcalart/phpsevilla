var gulp = require('gulp');
var concatCss = require('gulp-concat-css');
var cleanCSS = require('gulp-clean-css');
var uglify = require('gulp-uglifyjs');
var gutil = require('gulp-util');

var global = {
    assetsDirectory: 'templates/assets',
};

gulp.task('styles', function () {
    gutil.log(gutil.colors.red('Procesing css files.'));

    gulp.src([
        global.assetsDirectory + '/css/bootstrap.css',
		global.assetsDirectory + '/css/font-awesome.css',
		global.assetsDirectory + '/css/simple-line-icons.css',
		global.assetsDirectory + '/css/owl.carousel.css',
		global.assetsDirectory + '/css/owl.theme.default.css',
		global.assetsDirectory + '/css/theme.css',
		global.assetsDirectory + '/css/theme-elements.css',
		global.assetsDirectory + '/css/theme-blog.css',
		global.assetsDirectory + '/css/theme-shop.css',
		global.assetsDirectory + '/css/theme-animate.css',
		global.assetsDirectory + '/css/settings.css',
		global.assetsDirectory + '/css/layers.css',
		global.assetsDirectory + '/css/navigation.css"',
		global.assetsDirectory + '/css/component.css',
		global.assetsDirectory + '/css/skin-corporate-7.css'
    ])
        .pipe(concatCss('all.css'))
        .pipe(gulp.dest('web/assets/css'));
});

gulp.task('fonts', function () {
    gutil.log(gutil.colors.red('Copying the fonts'));

    return gulp.src(global.assetsDirectory + '/fonts/**/*.*')
        .pipe(gulp.dest('web/assets/fonts'));
});

gulp.task('scripts', function () {
    gutil.log(gutil.colors.red('Procesing js files'));

    return gulp.src([
        global.assetsDirectory + '/vendor/modernizr/modernizr.js',
		global.assetsDirectory + '/vendor/jquery/jquery.js',
		global.assetsDirectory + '/vendor/jquery.appear/jquery.appear.js',
		global.assetsDirectory + '/vendor/jquery.easing/jquery.easing.js',
		global.assetsDirectory + '/vendor/jquery-cookie/jquery-cookie.js',
		global.assetsDirectory + '/vendor/bootstrap/js/bootstrap.js',
		global.assetsDirectory + '/vendor/common/common.js',
		global.assetsDirectory + '/vendor/jquery.validation/jquery.validation.js',
		global.assetsDirectory + '/vendor/jquery.stellar/jquery.stellar.js',
		global.assetsDirectory + '/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js',
		global.assetsDirectory + '/vendor/jquery.gmap/jquery.gmap.js',
		global.assetsDirectory + '/vendor/jquery.lazyload/jquery.lazyload.js',
		global.assetsDirectory + '/vendor/isotope/jquery.isotope.js',
		global.assetsDirectory + '/vendor/owl.carousel/owl.carousel.js',
		global.assetsDirectory + '/vendor/magnific-popup/jquery.magnific-popup.js',
		global.assetsDirectory + '/vendor/vide/vide.js',
		global.assetsDirectory + '/js/theme.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/jquery.themepunch.tools.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.actions.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.carousel.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.kenburn.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.migration.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.navigation.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.parallax.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.slideanims.min.js',
		global.assetsDirectory + '/vendor/rs-plugin/js/extensions/revolution.extension.video.min.js',
		global.assetsDirectory + '/vendor/circle-flip-slideshow/js/jquery.flipshow.js',
		global.assetsDirectory + '/js/views/view.home.js',
		global.assetsDirectory + '/js/custom.js',
		global.assetsDirectory + '/js/theme.init.js'
    ])
        .pipe(uglify('all.js'))
        .pipe(gulp.dest('web/assets/js'));
});

/**
 * Images tasks
 */
gulp.task('images', function () {
    gutil.log(gutil.colors.red('Copying the images'));

    return gulp.src(global.assetsDirectory + '/img/*')
        .pipe(gulp.dest('web/assets/img'));
});

gulp.task('default', ['styles', 'fonts', 'scripts', 'images']);
