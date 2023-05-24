'use strict';

//REQUIRES

var gulp     = require('gulp');
var sass     = require('gulp-sass')(require('sass'));
var concat   = require('gulp-concat');
var uglify   = require('gulp-uglify');
var notify   = require('gulp-notify');

//otimizar imagens e converter para webp
var image    = require('gulp-image');
var webp     = require('gulp-webp');

//REQUIRES
//CONFIGS

var srcPath = 'site/themes/villareal-marina/src/';
var distPath = 'site/themes/villareal-marina/public/';

//SASS

var rsync = require('rsyncwrapper'),
    hostname = '167.99.167.245',
    username = 'arquivos',
    prod_src = './site/themes/',
    prod_dest = '/var/www/html/producao/site/themes/',
    homolog_src = './site/themes/',
    homolog_dest = '/var/www/html/projetos/villareal-marina/site/site/themes/',
    exclude = [
        ".fuse",
        ".directory",
        '.log',
        'error_log'
    ];

gulp.task('sass', function () {
    return gulp.src( srcPath + 'sass/*.sass')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest( distPath + 'css'))
        .pipe(notify('SASS OK!'));
});


//SCRIPTS

var jsFiles = [
    srcPath + 'js/mask.js',
    srcPath + 'js/main.js'
];

gulp.task('scripts', function() {
    return gulp.src(jsFiles)
        .pipe(concat('main.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest( distPath + 'js'))
        .pipe(notify('JS OK!'));
});

//WATCH

gulp.task('w', function () {

    gulp.watch( srcPath + 'sass/*.sass', gulp.series('sass'));
    gulp.watch( srcPath + 'sass/**/*.scss', gulp.series('sass'));

    gulp.watch( srcPath + 'js/*.js', gulp.series('scripts'));

});


const path = {
  dev: 'site/themes/villareal-marina/src/',
  root: 'site/themes/villareal-marina/',
  dist: 'site/themes/villareal-marina/public/',
  distRoot: 'site/themes/villareal-marina/public/'
};

gulp.task('png', function () {
  return gulp.src(path.dev + 'images/*.png')
    .pipe(image())
    .pipe(gulp.dest(path.dist + 'images/'));
});

gulp.task('jpg', function () {
  return gulp.src(path.dev + 'images/*.jpg')
    .pipe(image())
    .pipe(gulp.dest(path.dist + 'images/'));
});

gulp.task('webp', function () {
  return gulp.src(path.dev + 'images/*.png')
    .pipe(webp())
    .pipe(gulp.dest(path.dist + 'images/'));
});

function prod_listonly() {
  rsync({
      src: prod_src,
      dest: username + '@' + hostname + ':' + prod_dest,
      dryRun: true,
      recursive: true,
      delete: true,
      compareMode: 'checksum',
      exclude: exclude,
      args: [ '--verbose' ],
      onStdout: function( data ) {
          console.log( data.toString() );
      }
  }, function( error, stdout, stderr, cmd ) {
      console.log( 'END!' );
  });
}

function prod_upload() {
  rsync({
      src: prod_src,
      dest: username + '@' + hostname + ':' + prod_dest,
      recursive: true,
      delete: true,
      compareMode: 'checksum',
      exclude: exclude,
      args: [ '--verbose' ],
      onStdout: function( data ) {
          console.log( data.toString() );
      }
  }, function( error, stdout, stderr, cmd ) {
      console.log( 'END!' );
  });
}

function prod_download() {
  rsync({
      src: username + '@' + hostname + ':' + prod_dest,
      dest: prod_src,
      recursive: true,
      delete: true,
      compareMode: 'checksum',
      exclude: exclude,
      args: [ '--verbose' ],
      onStdout: function( data ) {
          console.log( data.toString() );
      }
  }, function( error, stdout, stderr, cmd ) {
      console.log( 'END!' );
  });
}

function homolog_listonly() {
  rsync({
      src: homolog_src,
      dest: username + '@' + hostname + ':' + homolog_dest,
      dryRun: true,
      recursive: true,
      delete: true,
      compareMode: 'checksum',
      exclude: exclude,
      args: [ '--verbose' ],
      onStdout: function( data ) {
          console.log( data.toString() );
      }
  }, function( error, stdout, stderr, cmd ) {
      console.log( 'END!' );
  });
}

function homolog_upload() {
  rsync({
      src: homolog_src,
      dest: username + '@' + hostname + ':' + homolog_dest,
      recursive: true,
      delete: true,
      compareMode: 'checksum',
      exclude: exclude,
      args: [ '--verbose' ],
      onStdout: function( data ) {
          console.log( data.toString() );
      }
  }, function( error, stdout, stderr, cmd ) {
      console.log( 'END!' );
  });
}

function homolog_download() {
  rsync({
      src: username + '@' + hostname + ':' + homolog_dest,
      dest: homolog_src,
      recursive: true,
      delete: true,
      compareMode: 'checksum',
      exclude: exclude,
      args: [ '--verbose' ],
      onStdout: function( data ) {
          console.log( data.toString() );
      }
  }, function( error, stdout, stderr, cmd ) {
      console.log( 'END!' );
  });
}

//exports.prod_listonly = gulp.series([prod_listonly]);
// exports.prod_upload = gulp.series([prod_upload]);
// exports.prod_download = gulp.series([prod_download]);
exports.homolog_listonly = gulp.series([homolog_listonly]);
exports.homolog_upload = gulp.series([homolog_upload]);
exports.homolog_download = gulp.series([homolog_download]);
