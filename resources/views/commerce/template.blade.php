@include('commerce/header')
<!DOCTYPE html>
<html>
	<head>
		<title>Tech Commerce</title>
		<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
		<style type="text/css">
			.v-line{
				border-left: 1px solid #f4645f;
			}
			.t-c{
				text-align: center;
			}
			.t-r{
				text-align: right;
			}
			.b{
				margin: 5px 5px 5px 5px;
				padding: 10px 5px 10px 5px;
				border:1px solid #f4645f;
				border-radius: 7px;
			}
			.item-img {
				width: 100px;
				height: 120px;
			}
			.h-p{
				width:100%;
			}
			.navbar-default{
				background-color: #F4645F;
			}
			.navbar-default .navbar-brand {
				color:white;
			}
			.navbar-default .navbar-nav>li>a {
				color:white;
			}
		</style>
		<script type="text/javascript" src="{{asset('js/jquery-3.1.1.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/html5shiv_3_7_2.min.js')}}"></script>
	</head>
	<body>
		<div>@yield('header')</div>
		<div style="clear:both"></div>
		@yield('content')
	</body>
</html>