// Load plugins
var gulp = require('gulp'),
    plugins = require('gulp-load-plugins')({ camelize: true }),
    lr = require('tiny-lr'),
    server = lr();

// Styles
gulp.task('styles', function() {
  return gulp.src('assets/styles/source/*.scss')
    .pipe(plugins.rubySass({ style: 'expanded', compass: true }))
    .pipe(plugins.autoprefixer('last 2 versions', 'ie 8', 'ie 9', 'ios 6', 'android 4'))
    .pipe(gulp.dest('assets/styles/build'))
    .pipe(plugins.minifyCss({ keepSpecialComments: 1 }))
    .pipe(plugins.livereload(server))
    .pipe(gulp.dest('./'))
    .pipe(plugins.notify({ message: 'Styles task complete' }));
});

// Vendor Plugin Scripts
// gulp.task('plugins', function() {
//   return gulp.src(['assets/js/source/plugins.js', 'assets/js/vendor/*.js'])
//     .pipe(plugins.concat('plugins.js'))
//     .pipe(gulp.dest('assets/js/build'))
//     .pipe(plugins.rename({ suffix: '.min' }))
//     .pipe(plugins.uglify())
//     .pipe(plugins.livereload(server))
//     .pipe(gulp.dest('assets/js'))
//     .pipe(plugins.notify({ message: 'Scripts task complete' }));
// });

// Site Scripts
gulp.task('scripts', function() {
  return gulp.src(['assets/js/source/*.js', '!assets/js/source/plugins.js'])
    .pipe(plugins.jshint('.jshintrc'))
    .pipe(plugins.include())
    .pipe(plugins.jshint.reporter('default'))
    .pipe(plugins.concat('main.js'))
    .pipe(gulp.dest('assets/js/build'))
    .pipe(plugins.rename({ suffix: '.min' }))
    .pipe(plugins.uglify())
    .pipe(plugins.livereload(server))
    .pipe(gulp.dest('assets/js'))
    .pipe(plugins.notify({ message: 'Scripts task complete' }));
});

// Images
gulp.task('images', function() {
  return gulp.src('assets/images/**/*.{png, jpg, gif}')
    .pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
    .pipe(plugins.livereload(server))
    .pipe(gulp.dest('assets/images'))
    .pipe(plugins.notify({ message: 'Images task complete' }));
});

// Svg
gulp.task('svg', function() {
  return gulp.src('assets/images/**/*.svg')
    .pipe(plugins.svgmin())
    .pipe(plugins.livereload(server))
    .pipe(gulp.dest('assets/images'))
    .pipe(plugins.notify({ message: 'Svg task complete' }));
});

// //Fonts -fontawesome
// gulp.task('fonts', function() {
//     var bowerSrc = plugins.bowerScr()
//     bowerSrc()
//     .pipe(plugins.filter('**/*.eot', '**/*.svg', '**/*.ttf', '**/*.woff'))
//     .pipe(gulp.dest('assets/fonts'))
//     .pipe(plugins.notify({ message: 'Fonts copy complete' }));

// });

//Bower Files
gulp.task('bowerCopy', function(){
  plugins.bowerFiles()
    .pipe(gulp.dest('assets/bower_components'))
    .pipe(plugins.notify({ message: 'Bower Components copy complete' }));
});

// Watch
gulp.task('watch', function() {

  // Listen on port 35729
  server.listen(35729, function (err) {
    if (err) {
      return console.log(err)
    };

    // Watch .scss files
    gulp.watch('assets/styles/source/**/*.scss', ['styles']);

    // Watch .js files
    gulp.watch('assets/js/**/*.js', ['scripts']);

    // Watch image files
    gulp.watch('assets/images/**/*', ['images', 'svg']);

  });

});

// Default task
gulp.task('default', ['styles', 'scripts', 'images', 'bowerCopy', 'watch']);
