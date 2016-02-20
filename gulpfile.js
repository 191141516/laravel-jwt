//var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

//elixir(function(mix) {
//    mix.sass('app.scss');
//});

var gulp = require('gulp');
var browserSync = require('browser-sync');

gulp.task('browerSync', function(){
    browserSync.init({
        proxy: "jwt.dev",    //apache或nginx等代理地址
        notify: false,              //刷新是否提示
        open: true                 //是否自动打开页面
    });
});

gulp.task('css', function(){
    return gulp.src('./node_modules/bootstrap/dist/css/bootstrap.css')
        .pipe(gulp.dest('./public/css'));
});

gulp.task('js', function(){
    var arr = [
        './node_modules/angular/angular.min.js',
        './node_modules/angular-ui-router/release/angular-ui-router.min.js',
        './node_modules/satellizer/satellizer.min.js'
    ];
    return gulp.src(arr)
        .pipe(gulp.dest('./public/js'));
});

gulp.task('script', function(){
    var js_arr = 'resources/assets/js/**/*.js';
    var css_arr = 'resources/assets/css/**/*.css';
    gulp.src(js_arr)
        .pipe(gulp.dest('./public/js'));

    gulp.src(css_arr)
        .pipe(gulp.dest('./public/css'));
});

gulp.task('html', function(){
    gulp.src('resources/views/angular/views/**/*.html')
        .pipe(gulp.dest('./public/views'));
});

gulp.task('copyfiles',['css', 'js', 'html', 'script']);

gulp.task('watch', ['browerSync', 'script'], function(){
    var script_arr = [
        'resources/assets/js/**/*.js',
        'resources/assets/css/**/*.css'
    ];
    gulp.watch('resources/views/**/*.php', browserSync.reload);
    gulp.watch(script_arr, browserSync.reload);
});

