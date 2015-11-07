<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ Config::get('webdefault.title') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/assets/admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/admin/css/admin.css">
    <link rel="stylesheet" href="/assets/admin/css/skins.css">

	@yield('css')

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">
		
		@include('mvsoft::partials.header.header') 

		@include('mvsoft::partials.side.leftSideBar')      

      <div class="content-wrapper">

        @include('mvsoft::partials.contentHeader')

        <section class="content">
        	@yield('content')
        </section>

      </div>

      @include('mvsoft::partials.footer')
      
      @include('mvsoft::partials.side.rightSidebar')  
      
    </div>

    <script src="/assets/admin/js/default.js"></script>

    @yield('js')

  </body>
</html>
