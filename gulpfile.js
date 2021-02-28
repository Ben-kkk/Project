let gulp = require('gulp');

let cssMin = require('gulp-cssmin');
let babel = require('gulp-babel');
let uglify = require('gulp-uglify')

let htmlMin = require('gulp-htmlmin');

let gulpclean = require('gulp-clean');

let webServer = require('gulp-webserver')

function css() {
    return gulp.src('./src/css/**')
        .pipe(cssMin())
    .pipe(gulp.dest('./dist/css'))
}

function js() {
  return gulp.src('./src/js/**')
      .pipe(
        babel({
          presets: ["env"]
        })
      )
      .pipe(uglify())
      .pipe(gulp.dest("./dist/js"))
}

function html() {
  return gulp.src("./src/html/**")
    .pipe(htmlMin({
        collapseWhitespace: true, // 表示去除空格
        removeEmptyAttributes: true, // 移出空的属性
        minifyCSS: true, // 压缩 style 标签
        minifyJS: true // 压缩 script 标签
      }))
    .pipe(gulp.dest("./dist/html"))
}

function img() {
  return gulp.src("./src/img/**")
    .pipe(gulp.dest('./dist/img'));
}

function api() {
  return gulp.src("./src/api/**")
    .pipe(gulp.dest("./dist/api"));
}

function clean() {
  return gulp.src(["./dist"])
          .pipe(gulpclean());
}

function server() {
  return gulp.src("./dist")
    .pipe(webServer({
      host: "localhost", // 域名
      port: 3000, // 监听的端口号，统一写 3000
      open: "./html/login.html", // 打开的页面，相对于 dist 文件夹来的目录
      livereload: true // 浏览器自动刷新
    })
  );
}

exports.css = css;
exports.js = js;
exports.html = html;
exports.img = img;
exports.api = api;
exports.clean = clean;
exports.server = server;

function watch() {
  gulp.watch("./src/css", css);
  gulp.watch("./src/js", js);
  gulp.watch("./src/html", html);
  gulp.watch("./src/api", api);
  gulp.watch("./src/img", img);
}

exports.build = gulp.series(clean,gulp.parallel(css,js,html,img,api),server,watch);


    