var gulp = require('gulp'),
sass = require('gulp-sass'),
jshint = require('gulp-jshint'),
concat = require('gulp-concat'),
path = require('path'),
minifyCSS = require('gulp-minify-css'),
imagemin = require('gulp-imagemin'),
plumber = require('gulp-plumber'),
notify = require('gulp-notify'),
livereload = require('gulp-livereload'),
fs = require('node-fs'),
fse = require('fs-extra'),
json = require('json-file'),
uglify = require('gulp-uglify'),
themeName = json.read('./package.json').get('name'),
themeDir = '../' + themeName,
plumberErrorHandler = { errorHandler: notify.onError({
 
    title: 'Gulp',
 
    message: 'Error: <%= error.message %>'
 
  })
 
};

gulp.task('default', function(){
 
    console.log('default gulp task...');
 
});

gulp.task('default', ['sass', 'js', 'imgPress', 'watch']);

gulp.task('init', function() {
 
  fs.mkdirSync(themeDir, 765, true);
 
  fse.copySync('theme-boilerplate', themeDir + '/');
 
});

gulp.task('files', function() {
 
  	gulp.src('./*.php')

  		.pipe(livereload());
 
});

gulp.task('sass', function () {
 
    gulp.src('./src/sass/*.scss')

    	.pipe(plumber(plumberErrorHandler))
 
       .pipe(sass())

       .pipe(minifyCSS())

       .pipe(concat('style.min.css'))
 
       .pipe(gulp.dest('./assets/css'))

       .pipe(livereload());
 
});
 

gulp.task('js', function () {
 
	gulp.src('./src/js/*.js')

		.pipe(plumber(plumberErrorHandler))
 
		.pipe(jshint())
 
		.pipe(jshint.reporter('fail'))

		.pipe(uglify())
		 
		.pipe(concat(themeName + '.min.js'))
		 
		.pipe(gulp.dest('./assets/js'))

		.pipe(livereload());
 
});

gulp.task('imgPress', function() {
 
  gulp.src('./src/images/*.{png,jpg,gif}')

	.pipe(plumber(plumberErrorHandler))
 
	.pipe(imagemin({
 
      		optimizationLevel: 7,
 
      		progressive: true
 
    	}))
 
    	.pipe(gulp.dest('./assets/images'))

    	.pipe(livereload());
 
});

gulp.task('watch', function() {

	livereload.listen({ start: true });
 
	gulp.watch('./src/sass/*.scss', ['sass']);
 
	gulp.watch('./src/js/*.js', ['js']);
 
	gulp.watch('./src/images/*.{png,jpg,gif}', ['imgPress']);

	gulp.watch('./*.php', ['files']);
 
});