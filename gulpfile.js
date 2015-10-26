var elixir = require('laravel-elixir');

elixir(function(mix) {
    
    //Frontend configuration
    mix.less([
    	'webAdmin.less',
    ], 'public/assets/admin/css/admin.css');

});
