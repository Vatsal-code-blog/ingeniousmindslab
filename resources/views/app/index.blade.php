<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="{{ url('') }}">
		<meta charset="UTF-8">
		<meta content="ie=edge" http-equiv="x-ua-compatible">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
		<meta name="msapplication-tap-highlight" content="no"/>
		<meta name="_token" content="{{ csrf_token() }}" />
		@if( isset( $_meta_title ) && $_meta_title )
		<title>{{$_meta_title}}</title>
		@else
			<title>@yield('title', "Pract")</title>
		@endif 
		@if( isset( $_meta_keyword ) && $_meta_keyword )
			<meta name="keywords" content="{{$_meta_keyword}}">
		@endif
		@if( isset( $_meta_desc ) && $_meta_desc )
			<meta name="description" content="{{$_meta_desc}}">
		@endif
		<link rel="stylesheet" href="{{ url('/public/fonts/fonts.css?v=1.0') }}">
		<link rel="stylesheet" href="{{ url('/public/css/app.css?v=1.0') }}">
		<script src="{{ url('/public/js/app.js?v=1.0') }}"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		@yield('css')
	</head>
	<body>
	    @include('app.header')
		@yield('content')
		@yield('js')
	</body>
</html>
<!-- Localized -->