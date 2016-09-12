var gulp = require('gulp');
var stylus = require('gulp-stylus');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var pjson = require('./package.json');

gulp.task('css:development', function() {
  gulp.src('./assets/css/main.styl')
    .pipe(stylus({
      compress: false,
      'include css': true
    }))
    .pipe(rename(pjson.name + '.css'))
    .pipe(gulp.dest('./assets/dist/'));
});

gulp.task('css:production', function() {
  gulp.src('./assets/css/main.styl')
    .pipe(stylus({
      compress: true,
      'include css': true
    }))
    .pipe(rename(pjson.name + '.min.css'))
    .pipe(gulp.dest('./assets/dist/'));
});

gulp.task('js:development', function() {
  return gulp.src('assets/js/*.js')
    .pipe(uglify({
      compress: false
    }))
    .pipe(rename(pjson.name + '.js'))
    .pipe(gulp.dest('./assets/dist'));
});

gulp.task('js:production', function() {
  return gulp.src('assets/js/*.js')
    .pipe(uglify())
    .pipe(rename(pjson.name + '.min.js'))
    .pipe(gulp.dest('./assets/dist'));
});

gulp.task('watch', function() {
  gulp.watch('./assets/css/**/*.styl', ['css:development']);
  gulp.watch('./assets/css/**/*.js', ['js:development']);
});

gulp.task('default', [
  'js:production',
  'css:production',
  'js:development',
  'css:development'
]);
