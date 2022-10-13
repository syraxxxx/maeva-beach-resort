gulp.task('ngScripts', () => {
  var sources = browserify({entries: './includes/admin/theme_options/includes/src/index.main.js'});
  sources.transform(babelify);

  var i = 0;

  function bundle() {
    return sources.bundle()
      .on('error', function (err) {
        console.error(err);
      })
      .pipe(vinylSourceStream('../../assets/js/app.min.js'))
      .pipe(vinylBuffer())
      .pipe(gulp.dest('./includes/admin/theme_options/includes/angular_app'))
      .pipe(livereload())
  }

  return bundle();
});

gulp.task('nghtml', function () {
  "use strict";
  gulp.src('./includes/admin/theme_options/includes/src/**/*.html')
    .pipe(gulp.dest('./includes/admin/theme_options/includes/angular_app/'))
});