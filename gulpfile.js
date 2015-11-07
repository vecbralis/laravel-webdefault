var gulp    = require('gulp');
var connect = require('gulp-connect-php');
var shell   = require('gulp-shell');
var elixir  = require('laravel-elixir');
var notify  = require("gulp-notify");
var watch   = require('gulp-watch');
var gutil   = require('gulp-util');
var browserSync = require('browser-sync').create();
var reload      = browserSync.reload;

elixir(function(mix) {
    
    //Default admin configuration
    mix.less([
    	'webAdmin.less',
        '../../../plugins/select2/select2.css',
        '../../../plugins/iCheck/square/blue.css'
    ], 'public/assets/admin/css/admin.css')
    .less([
            'skins/*.less'
        ], 'public/assets/admin/css/skins.css')
    
    //Login page scripts
    .scripts([
            '../../../plugins/jQuery/jQuery-2.1.4.min.js',
            '../../../public/assets/admin/bootstrap/js/bootstrap.min.js',
            '../../../plugins/iCheck/icheck.min.js',
            'login/**/*.js'
        ], 'public/assets/admin/js/login.js')

    //Default scripts
    .scripts([
            '../../../node_modules/jquery/dist/jquery.min.js',
            '../../../plugins/jQueryUI/jquery-ui.min.js',
            'beforeBootstrap/**/*.js',
            '../../../node_modules/bootstrap/dist/js/bootstrap.min.js',
            '../../../plugins/select2/select2.full.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
            '../../../plugins/daterangepicker/daterangepicker.js',
            '../../../plugins/datepicker/bootstrap-datepicker.js',
            '../../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
            '../../../plugins/slimScroll/jquery.slimscroll.min.js',
            '../../../plugins/fastclick/fastclick.min.js',
            'beforeAngular/**/*.js',
            '../../../node_modules/angular/angular.min.js',
            '../../../node_modules/angular-animate/angular-animate.min.js',
            'afterAnguar/**/*.js'
        ], 'public/assets/admin/js/default.js')
        .copy('public/assets/admin', '../../../public/assets/admin');
});


//Watch for view changes and publish it automatic
gulp.task("view-watch", function(){

    browserSync.init({
        proxy: {
            target: "http://compare.local.lv",
            ws: true
        }
    });

    watch("resources/views/**/*.php", function(){
        gulp.src("").pipe(shell("cd ../../../ && php artisan vendor:publish --tag=mvsoft.webdefault.views --force && echo DONE"))
        .pipe(notify("MVsoft webdefault view file changes saved."))
        .pipe(browserSync.stream());
    });

    //Reload on config change or PHP file change
    watch("src/**/*.php", browserSync.reload);

});

//Watch for migrations
gulp.task('migrations-watch', function(){
    watch("migrations/**/*.php", function(){
        gulp.src("").pipe(shell("cd ../../../ && php artisan vendor:publish --tag=mvsoft.webdefault.migrations --force && echo DONE"));
        gulp.src("").pipe(notify("MVsoft webdefault migrations file changes saved."));
    });
});

//Automatic git on file changes
var runGit = function(){
    gulp.src("").pipe(shell("git add -A && git commit -m '"+gutil.env.message+"' && git push"));
    gulp.src("").pipe(notify("MVsoft Webdefault git changes pushed"));
};

gulp.task('git-auto', function(){
    watch("public/**/*", function(){
        runGit();
    });
    watch("migrations/**/*", function(){
        runGit();
    });
    watch("src/**/*", function(){
        runGit();
    });
    watch("resources/**/*", function(){
        runGit();
    });
});


