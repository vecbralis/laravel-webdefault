var gulp    = require('gulp');
var connect = require('gulp-connect-php');
var shell   = require('gulp-shell');
var elixir  = require('laravel-elixir');
var notify = require("gulp-notify");
var watch = require('gulp-watch');
var gutil = require('gulp-util');

elixir(function(mix) {
    
    //Default admin configuration
    mix.less([
    	'webAdmin.less',
        '../../../node_modules/angular/angular-csp.css',
        '../../../node_modules/angular-loading-bar/src/loading-bar.css',
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
            '../../../plugins/select2/select2.full.min.js',
            '../../../node_modules/bootstrap/dist/js/bootstrap.min.js',
            '../../../node_modules/angular/angular.min.js',
            '../../../node_modules/angular-ui-router/build/angular-ui-router.js',
            '../../../node_modules/angular-loading-bar/src/loading-bar.js',
            '../../../node_modules/angular-animate/angular-animate.min.js',
            '../../../node_modules/angular-bootstrap/ui-bootstrap.min.js'
        ], 'public/assets/admin/js/default.js')
        .copy('public/assets/admin', '../../../public/assets/admin');
});


//Watch for view changes and publish it automatic
gulp.task("view-watch", function(){
    watch("resources/views/**/*.php", function(){
        gulp.src("").pipe(shell("cd ../../../ && php artisan vendor:publish --tag=mvsoft.webdefault.views --force && echo DONE"));
        gulp.src("").pipe(notify("MVsoft webdefault view file changes saved."));
    });
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


