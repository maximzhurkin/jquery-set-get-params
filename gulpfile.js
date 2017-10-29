var gulp = require('gulp'),
	plumber = require('gulp-plumber'),
	environments = require('gulp-environments'),
	watch = require('gulp-watch'),
	rename = require('gulp-rename'),
	pug = require('gulp-pug'),
	coffee = require('gulp-coffee'),
	stylus = require('gulp-stylus'),
	uglify = require('gulp-uglify'),
	csso = require('gulp-csso'),
	autoprefixer = require('gulp-autoprefixer'),
	sourcemaps = require('gulp-sourcemaps'),
	stripDebug = require('gulp-strip-debug'),
	browserSync = require('browser-sync').create();

gulp.task('serve', function() {
	browserSync.init({
		server: {
			baseDir: "./dist"
		},
		notify: false
	});
});

gulp.task('html', function() {
	return gulp.src('./src/pug/*.pug')
		.pipe(plumber())
		.pipe(pug({
			pretty: '\t'
		}))
		.pipe(gulp.dest('./dist/'))
		.pipe(browserSync.reload({ stream: true }));
});

gulp.task('coffee', function() {
	return gulp.src('./src/coffee/**/*.coffee')
		.pipe(plumber())
		.pipe(coffee({ bare: true }))
		.pipe(gulp.dest('./dist/assets/scripts/'))
		.pipe(environments.production(rename({
			suffix: '.min'
		})))
		.pipe(environments.production(uglify({
			preserveComments: 'license',
			mangle: true
		})))
		.pipe(environments.production(stripDebug()))
		.pipe(environments.development(sourcemaps.write()))
		.pipe(gulp.dest('./dist/assets/scripts/'))
		.pipe(browserSync.stream({ match: '**/*.js' }));
});

gulp.task('css', function() {
	return gulp.src(['./src/stylus/*.styl', '!./src/stylus/core/'])
		.pipe(plumber())
		.pipe(environments.development(sourcemaps.init()))
		.pipe(stylus({'include css': true}))
		.pipe(autoprefixer({ browsers: ['last 2 versions', 'ios >= 7','firefox >=4','safari >=7','IE >=8','android >=2'] }))
		.pipe(environments.production(csso()))
		.pipe(environments.development(sourcemaps.write()))
		.pipe(gulp.dest('./dist/assets/styles/'))
		.pipe(browserSync.stream({ match: '**/*.css' }));
});

gulp.task('watch', function () {
	watch(['./src/coffee/**/*.coffee'], function() {
		gulp.start('coffee');
	});
	watch(['./src/stylus/**/*.styl'], function() {
		gulp.start('css');
	});
	watch(['./src/pug/**/*.pug'], function() {
		gulp.start('html');
	});
});

gulp.task('default', ['html', 'coffee', 'css', 'watch', 'serve']);
