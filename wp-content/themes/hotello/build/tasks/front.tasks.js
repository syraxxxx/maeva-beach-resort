gulp.task('front-js', () => {
  "use strict";
  watch(config.paths.javascript + '/**/*.js', {ignoreInitial: false})
    .pipe(babel({
      presets: ['env']
    }))
    .pipe(stripComments())
    .pipe(gulp.dest(config.paths.public + '/js'))
});


gulp.task('front-css', () => {
  watch(config.paths.sass + '/**/*.scss', {ignoreInitial: false}).on('change', () => {
    console.log(123);
    gulp.src(config.paths.sass + '/**/*.scss')
      .pipe(changed(config.paths.public + '/css'))
      .pipe(sass().on('error', sass.logError))
      .pipe(autoPrefixer({
        browsers: ['last 4 versions'],
        cascade: false
      }))
      .pipe(gulp.dest(config.paths.public + '/css'))
      .pipe(browserSync.stream())
  })

});

gulp.task('front-vendors', () => {
  let vendors = {
    'owl.carousel': [
      'dist/owl.carousel.js',
      'dist/assets/*.*'
    ],
    'font-awesome': [
      'css/font-awesome.css'
    ]
  };
  let sources = [];
  let dest = config.paths.vendors;

  for (let module in vendors) {
    vendors[module].forEach(v => {
      // src.push(`${config.paths.nodeModules}/${module}/${v}`);
      let src = `${config.paths.nodeModules}/${module}/${v}`;
      sources.push(src);
    });

    gulp.src(sources)
      .pipe(gulp.dest(dest));

  }
});

gulp.task('front-images', () => {
  gulp.src(config.paths.images + '/**/*.*')
    .pipe(imageMin())
    .pipe(gulp.dest(config.paths.public + '/images'))
});

gulp.task('front-fonts', () => {
  return gulp.src(config.paths.nodeModules + '/font-awesome/fonts/*.*')
    .pipe(gulp.dest(config.paths.public + '/fonts'))
});