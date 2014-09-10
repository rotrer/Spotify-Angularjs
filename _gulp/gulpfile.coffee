# include gulp
gulp           = require("gulp")

# include our plugins
sass           = require("gulp-sass")
shell          = require("gulp-shell")
plumber        = require("gulp-plumber")
notify         = require("gulp-notify")
minifycss      = require("gulp-minify-css")
autoprefixer   = require("gulp-autoprefixer")
concat         = require("gulp-concat")
rename         = require("gulp-rename")
uglify         = require("gulp-uglify")
coffee         = require("gulp-coffee")
cache          = require("gulp-cached")
clean          = require("gulp-clean")
browserSync    = require("browser-sync")
gulpStripDebug = require("gulp-strip-debug")
lr             = require("tiny-lr")
livereload     = require("gulp-livereload")
templateCache  = require('gulp-angular-templatecache');
server         = lr()

# paths
src          = "src"
dest         = "../public/"

#
#  gulp tasks
#  ==========================================================================


# clean
gulp.task "clean", ->
  gulp.src [
    dest + "/scripts/*.*"
    dest + "/styles/*.*"
    dest + "/img/*.*"
    dest + "*.html"
  ]
  .pipe clean()

#
# Dev task
# ====================
# 
#copy js scripts app
gulp.task "copy-js-libs", ->
  gulp.src [
    "bower_components/angular/angular.js",
    "bower_components/jquery/jquery.js",
  ]
  .pipe gulp.dest dest + "assets/scripts"
#copy js scripts app
gulp.task "copy-js", ->
  gulp.src [
    src + "/scripts/*.js"
  ]
  .pipe gulp.dest dest + "assets/scripts"
  .pipe livereload(server)
#copy template
gulp.task "copy-tpl", ->
  gulp.src [
    src + "/template/*.php"
  ]
  .pipe gulp.dest "../app/views"
  .pipe livereload(server)
#copy template
# gulp.task "copy-html", ->
#   gulp.src [
#     src + "/html/partials/*.html"
#   ]
#   .pipe gulp.dest dest + "partials"
#   .pipe livereload(server)
gulp.task "copy-html", ->
  gulp.src [
    src + "/html/partials/*.html"
  ]
  .pipe(templateCache())
  .pipe gulp.dest dest
  .pipe livereload(server)
gulp.task 'watch', ->
  gulp.watch [src + '/scripts/*.js'], ['copy-js']
  gulp.watch [src + '/template/*.php'], ['copy-tpl']
  gulp.watch [src + '/html/partials/*.html'], ['copy-html']

#
# Dist task
# ====================
# 





#
#  main tasks
#  ==========================================================================

# default task
gulp.task 'default', [
  "copy-js-libs"
  "copy-js"
  "copy-tpl"
  "copy-html"
  "watch"
]
