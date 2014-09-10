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
dest         = "../assets/"

#
#  gulp tasks
#  ==========================================================================

