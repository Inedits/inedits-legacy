/*global require: false*/
"use strict";

// Config
var gulp = require('gulp'),
    sass          = require('gulp-sass'),           // SASS
    cleanCSS      = require('gulp-clean-css'),      // Clean CSS
    concat        = require('gulp-concat'),         // Concatenate
    uglify        = require('gulp-uglify'),         // JS minify
    rev           = require('gulp-rev'),            // Cache Bust
    stripComments = require('gulp-strip-comments'), // Strip Comments
    watch         = require('gulp-watch')           // Watch
;

var config = {
    // Private
    nodeModulesDir: 'node_modules',
    bootstrapDir:   'vendor/twbs/bootstrap-sass',
    masonryDir:     'vendor/desandro/masonry',
    jqueryDir:      'vendor/components/jquery',
    jqueryuiDir:    'vendor/components/jqueryui',
    scriptsDir:     'assets/js',
    stylesheetsDir: 'assets/css',
    mediasDir:      'assets/media',
    // Public
    cssPublicDir:   'web/dist/css',
    fontPublictDir: 'web/dist/font',
    jsPublicDir:    'web/dist/js',
    mediaPublicDir: 'web/dist/media',
};
var watchPaths = {
    stylesheets: ['assets/css/*.scss'],
    scripts:     ['assets/js/*.js'],
    medias:      ['assets/media/**/*'],
};

/*
* Default - prepare all assets
*/
gulp.task('default',['css','js','font', 'media']);

/*
* CSS
*/
gulp.task('css', function() {
    gulp.src(config.stylesheetsDir + '/app.scss')
        .pipe(sass({
            includePaths: [
                config.bootstrapDir + '/assets/stylesheets',
                config.jqueryuiDir  + '/themes/base'
            ],
        }))
        // .pipe(rev())
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest(config.cssPublicDir))
    ;
});

/*
* FONTS
*/
gulp.task('font', function() {
    gulp.src(config.bootstrapDir + '/assets/fonts/bootstrap/*')
        .pipe(gulp.dest(config.fontPublictDir))
    ;
});

/*
* JS
*/
gulp.task('js', function(){
    gulp.src([
            config.jqueryDir        + '/jquery.js',
            config.jqueryuiDir      + '/jquery-ui.js',
            config.scriptsDir       + '/d3.js',
            config.scriptsDir       + '/d3-tips.js',
            config.bootstrapDir     + '/assets/javascripts/bootstrap/affix.js',
            config.bootstrapDir     + '/assets/javascripts/bootstrap/alert.js',
            config.bootstrapDir     + '/assets/javascripts/bootstrap/collapse.js',
            config.bootstrapDir     + '/assets/javascripts/bootstrap/dropdown.js',
            config.bootstrapDir     + '/assets/javascripts/bootstrap/modal.js',
            config.bootstrapDir     + '/assets/javascripts/bootstrap/tab.js',
            config.bootstrapDir     + '/assets/javascripts/bootstrap/tooltip.js',
            config.bootstrapDir     + '/assets/javascripts/bootstrap/transition.js',
            config.masonryDir       + '/dist/masonry.pkgd.js',
            config.scriptsDir       + '/*.js'
        ])
        .pipe(concat('app.js'))
        .pipe(stripComments())
        .pipe(uglify())
        .pipe(gulp.dest(config.jsPublicDir))
    ;
});

gulp.task('js', function(){
    gulp.src([
            config.scriptsDir       + '/main.js'
        ])
        .pipe(concat('backend.js'))
        .pipe(stripComments())
        .pipe(uglify())
        .pipe(gulp.dest(config.jsPublicDir))
    ;
});

/*
* Images from assets to dist
*/
gulp.task('media', function(){
    gulp.src(config.mediasDir + '/**/*')
        .pipe(gulp.dest(config.mediaPublicDir));
});

/*
* Watch files
*/
gulp.task('watch', function(){
    gulp.watch(watchPaths.stylesheets, ['css']);
    gulp.watch(watchPaths.scripts, ['js']);
    gulp.watch(watchPaths.medias, ['media']);
});
