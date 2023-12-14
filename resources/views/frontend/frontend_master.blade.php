<!DOCTYPE html>
<html lang="bn">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="{{ url('ui/frontend_assets') }}/img/favicons/favicon.ico">

	<title>World Shine</title>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="{{ url('ui/frontend_assets') }}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ url('ui/frontend_assets') }}/css/tiny-slider.css">
	<link rel="stylesheet" href="{{ url('ui/frontend_assets') }}/css/meanmenu.css">
	<link rel="stylesheet" href="{{ url('ui/frontend_assets') }}/css/fontawesome.min.css">
	<link rel="stylesheet" href="{{ url('ui/frontend_assets') }}/css/icofont.min.css">
	<link rel="stylesheet" href="{{ url('ui/frontend_assets') }}/css/style.css">
</head>

<body>

	<!-- Mobile Menu Overlay -->
	<div class="overlay-inn"></div>


    @include('frontend.body.header')



	<main>

        @yield('main-content')



	</main>

    @include('frontend.body.footer')





	<!-- ==================== Scripts ==================== -->
	<!------------------------------------------------------->

	<!-- <script src="assets/js/vendor/jquery.slim.min.js"></script> -->
	<!-- <script src="assets/js/vendor/jquery-3.5.1.js"></script> -->
	<script src="{{ url('ui/frontend_assets') }}/js/vendor/jquery.js"></script>

	<script src="{{ url('ui/frontend_assets') }}/js/vendor/jquery.meanmenu.js"></script>
	<script src="{{ url('ui/frontend_assets') }}/bootstrap.bundle.min.js"></script>
	<script src="{{ url('ui/frontend_assets') }}/smooth-scroll.polyfills.min.js"></script>
	<script src="{{ url('ui/frontend_assets') }}/js/vendor/tiny-slider.js"></script>
	<script src="{{ url('ui/frontend_assets') }}/js/vendor/lightgallery.min.js"></script>
	<script src="{{ url('ui/frontend_assets') }}/js/vendor/lg-video.min.js"></script>

	<!-- Main script-->
	<script src="{{ url('ui/frontend_assets') }}/js/main-script.js"></script>

</body>

</html>
