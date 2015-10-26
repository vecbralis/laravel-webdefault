var elixir = require('laravel-elixir');

elixir(function(mix) {
    
    //Frontend configuration
    mix.sass([
    	'app.scss',
    ], 'public/assets/css/app.css')
    .scripts([
    		'../../../node_modules/jquery/jquery.min.js',
    		'../../../node_modules/bootstrap/dist/js/bootstrap.min.js',
    		'frontend/default/*.js',
    		'frontend/default/**/*.js'
    	], 'public/assets/js/app.js')

    //Booking part design and scripts
   	.sass([
   			'../../../node_modules/bootstrap-datetimepicker.js/css/bootstrap-datetimepicker.min.css',
   			'booking.scss'
   		], 'public/assets/css/booking.css')
    .scripts([
    		'../../../node_modules/bootstrap-datetimepicker.js/js/bootstrap-datetimepicker.min.js',
    		'frontend/booking/*.js',
    		'frontend/booking/**/*.js'
    	], 'public/assets/js/booking.js')

    //Driver configuration
    .sass([
    		'../../../node_modules/bootstrap-datetimepicker.js/css/bootstrap-datetimepicker.min.css',
    		'../../../node_modules/fullcalendar/dist/fullcalendar.min.css',
    		'../../../node_modules/fullcalendar/dist/fullcalendar.print.css',
    		'driver.scss'
    	], 'public/assets/css/driver.css')
    .scripts([
    		'../../../node_modules/bootstrap-datetimepicker.js/js/bootstrap-datetimepicker.min.js',
    		'../../../node_modules/fullcalendar/dist/fullcalendar.min.js',
    		'frontend/driver/*.js',
    		'frontend/driver/**/*.js'
    	], 'public/assets/js/driver.js')

   	//Version file list for elixir
    .version([
    		'assets/css/app.css',
    		'assets/css/booking.css',
    		'assets/css/driver.css',
    		'assets/js/app.js',
    		'assets/js/booking.js',
    		'assets/js/driver.js'
    	]);

});
