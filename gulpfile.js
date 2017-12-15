var gulp = require('gulp');
var concat = require('gulp-concat');

gulp.task('css', function() {
    return gulp.src([
            './public/css/bootstrap.min.css',
            './public/css/halflings.css',
            './public/css/font-awesome.css',
            './public/css/bootstrap-responsive.min.css',
            './public/css/style.css',
            './public/css/layerslider.css',
            './public/css/main.css',
            './public/css/posts.css',
            './public/css/jquery-ui-timepicker-addon.css',
            './public/css/jquery-ui-1.10.4.min.css',
            './public/css/simplemde.min.css'
        ])
        .pipe(concat('all.css'))
        .pipe(gulp.dest('./public/'))
});

gulp.task('scripts', function() {
    return gulp.src([
            './public/js/jquery-1.9.1.min.js',
            './public/js/jquery.isotope.min.js',
            './public/js/jquery-ui-1.10.4.min.js',
            './public/js/jquery-ui-timepicker-addon.js',
            './public/js/jquery.imagesloaded.js',
            './public/js/bootstrap.min.js',
            './public/js/flexslider.js',
            './public/js/carousel.js',
            './public/js/jquery.cslider.js',
            './public/js/slider.js',
            './public/js/jquery.fancybox.js',
            './public/js/twitter.js',
            './public/js/jquery.placeholder.min.js',
            './public/js/jquery-easing-1.3.js',
            './public/js/layerslider.kreaturamedia.jquery.js',
            './public/js/excanvas.js',
            './public/js/modernizr.js',
            './public/js/jquery.lazyload.min.js',
            './public/js/retina.js',
            './public/js/custom.js',
            './public/js/main.js'
        ])
        .pipe(concat('all.js'))
        .pipe(gulp.dest('./public/'))
});

gulp.task('angular', function() {
    return gulp.src([
            './public/js/angular.js',
            './public/js/liveSearch.js',
            './public/js/app/search.js'
        ])
        .pipe(concat('angular_all.js'))
        .pipe(gulp.dest('./public/'))
});