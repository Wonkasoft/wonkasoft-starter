var gulp = require('gulp'),
sass = require('gulp-sass'),
sourcemaps = require('gulp-sourcemaps'),
jshint = require('gulp-jshint'),
concat = require('gulp-concat'),
path = require('path'),
cleanCSS = require('gulp-clean-css'),
plumber = require('gulp-plumber'),
notify = require('gulp-notify'),
browserSync = require('browser-sync').create(),
fs = require('node-fs'),
fse = require('fs-extra'),
json = require('json-file'),
jsmin = require('gulp-js-minify'),
themeName = json.read('./package.json').get('name'),
siteName = json.read('./package.json').get('siteName'),
local = json.read('./package.json').get('localhost'),
themeDir = '../' + themeName,
plumberErrorHandler = { errorHandler: notify.onError({

	title: 'Gulp',

	message: 'Error: <%= error.message %>',

	line: 'Line: <%= line %>'

})

};

gulp.task('browser-sync', function() {
	browserSync.init({
		proxy: {
			target: local + siteName,
			ws: true
		},
		watch: true,
		https: true,
		port: 4000
	});
});

gulp.task('sass', function () {

	return gulp.src('./sass/style.scss')

	.pipe(sourcemaps.init())

	.pipe(plumber(plumberErrorHandler))

	.pipe(sass())

	.pipe(cleanCSS())

	.pipe(concat('style.css'))

	.pipe(sourcemaps.write('./maps'))

	.pipe(gulp.dest('./'))

	.pipe(browserSync.stream())

	.pipe(notify({
		message: "✔︎ Style CSS task complete",
		onLast: true
	}));

});

gulp.task('sass2', function () {

	return gulp.src('./sass/woocommerce.scss')

	.pipe(sourcemaps.init())

	.pipe(plumber(plumberErrorHandler))

	.pipe(sass())

	.pipe(cleanCSS())

	.pipe(concat('woocommerce.css'))

	.pipe(sourcemaps.write('./maps'))

	.pipe(gulp.dest('./'))

	.pipe(browserSync.stream())

	.pipe(notify({
		message: "✔︎ Woocommerce CSS task complete",
		onLast: true
	}));

});

gulp.task('js', function () {

	return gulp.src('./js/*.js')

	.pipe(concat(themeName + '.min.js'))

	.pipe(plumber(plumberErrorHandler))

	.pipe(jshint())

	.pipe(jshint.reporter('default'))

	.pipe(jshint.reporter('fail'))

	.pipe(jsmin())
	
	.pipe(sourcemaps.write('./maps'))

	.pipe(gulp.dest('./assets/js'))

	.pipe(browserSync.stream())

	.pipe(notify({ message: "✔︎ Wonkamizer JS task complete"}));


});

gulp.task('watch', function() {

	gulp.watch('./**/*.php').on('change', browserSync.reload);

	gulp.watch('./sass/**/*.scss', gulp.series(gulp.parallel('sass', 'sass2'))).on('change', browserSync.reload);

	gulp.watch('./js/**/*.js', gulp.series(gulp.parallel('js'))).on('change', browserSync.reload);

});

gulp.task('default', gulp.series(gulp.parallel('sass', 'sass2', 'js', 'browser-sync', 'watch')));