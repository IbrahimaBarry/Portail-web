<!doctype html>
<html lang="en">

<head>
	<title>Espace administration du portail</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="/assets/vendor/toastr/toastr.min.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="/assets/css/demo.css">
	<link rel="stylesheet" type="text/css" href="/css/iziToast.min.css">

	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">

	@yield('css')

</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown hidden-xs">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								@if (count(Auth::user()->unreadNotifications))
									<span class="badge bg-danger">{{ count(Auth::user()->unreadNotifications) }}</span>
								@endif
							</a>
							<ul class="dropdown-menu notifications">
								@foreach (Auth::user()->unreadNotifications as $notification)
									<li>
										<a href="#" class="notification-item"><span class="dot bg-{{$notification->type}}"></span>
											{{ $notification->data['info'] }}<br>
											<i>{{ $notification->created_at->toFormattedDateString() }}</i>
										</a>
									</li>
								@endforeach
								<li><a href="#" class="more">Afficher tous</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" class="lnr lnr-exit"></i> <span>Déconnexion
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		@yield('leftSidebar')
		<!-- END LEFT SIDEBAR -->

		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							@yield('content')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Javascript -->
	<script src="/assets/vendor/jquery/jquery.min.js"></script>
	<script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets/vendor/toastr/toastr.min.js"></script>
	<script src="/assets/scripts/klorofil-common.js"></script>
	<script type="text/javascript" src="/js/iziToast.min.js"></script>

	@if (Session::has('success'))
		<script type="text/javascript">
			iziToast.success({
			    title: 'OK',
			    message: '<?php echo Session::get('success') ?>',
			    position: 'topCenter',
			});
		</script>
	@endif

	@if (Session::has('info'))
		<script type="text/javascript">
			iziToast.info({
			    title: 'Info',
			    message: '<?php echo Session::get('info') ?>',
			    position: 'topRight',
			});
		</script>
	@endif

	@if (Session::has('error'))
		<script type="text/javascript">
			iziToast.error({
			    title: 'Erreur',
			    message: '<?php echo Session::get('error') ?>',
			    position: 'topRight',
			});
		</script>
	@endif

	@yield('javascript')

</body>
</html>