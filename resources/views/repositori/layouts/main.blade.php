<!doctype html>
<html lang="en">
  <head>
  	<title>Repositori Dokumen Sekolah</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="300">
    <meta name="_token" content="{{csrf_token()}}" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">		
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('sidebar_template/css/style.css')}}">
  </head>
  <body>
    @yield('content')   
    <script src="{{asset('sidebar_template/js/jquery.min.js')}}"></script>
    <script src="{{asset('sidebar_template/js/popper.js')}}"></script>
    <script src="{{asset('sidebar_template/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('sidebar_template/js/main.js')}}"></script>
  </body>
</html>