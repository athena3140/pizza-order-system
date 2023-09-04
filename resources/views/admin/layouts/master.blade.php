<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Title Page-->
	<title>@yield('title')</title>

	<!-- Fontfaces CSS-->
	<link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
	<link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
	<!-- Bootstrap CSS-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<!-- Vendor CSS-->
	<link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
	<link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
	<link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
	<link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
	<link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
	<link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
	<link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

	{{-- Link CSS --}}
	<link href="https://unpkg.com/tippy.js@5.2.1/dist/backdrop.css" rel="stylesheet">
	<link href="https://unpkg.com/tippy.js@5.2.1/animations/shift-toward.css" rel="stylesheet" />
	<link type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">

	<!-- Main CSS-->
	<link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

	{{-- Link Js --}}
	<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<link href="{{ asset('assets/css/adminMain.css') }}" rel="stylesheet">
</head>

<body>
	<div class="page-wrapper">
		<!-- MENU SIDEBAR-->
		<aside class="menu-sidebar d-none d-lg-block">
			<div class="logo">
				<a href="#">
					<img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
				</a>
			</div>
			<div class="menu-sidebar__content js-scrollbar1">
				<nav class="navbar-sidebar">
					<ul class="list-unstyled navbar__list">
						<li>
							<div class="d-flex justify-content-between align-items-center">
								<a class="expection cursor-pointer">
									<i class="fa-solid fa-gear"></i>
									Account Settings
								</a>
								<span class="plus">
									<i class="fa-solid fa-plus cursor-pointer"></i>
								</span>
							</div>
							<div class="ps-3 firstToogle position-relative">
								<div class="line"></div>
								<div class="d-flex align-items-center">
									<i class="nested-branch me-1"></i>
									<a class="d-flex justify-content-between w-100" href="{{ route('admin#edit') }}"><span>Edit Profile</span> <i class="fa-solid fa-user-pen"></i></a>
								</div>
								<div class="d-flex align-items-center">
									<i class="nested-branch me-1"></i>
									<a class="d-flex justify-content-between w-100" href="{{ route('admin#changePassword') }}"><span>Change Password</span> <i class="fa-solid fa-user-lock"></i></a>
								</div>
								<div class="d-flex align-items-center">
									<i class="nested-branch me-1"></i>
									<a class="d-flex justify-content-between w-100" href="{{ route('admin#lists') }}"><span>Account Lists</span> <i class="fa-solid fa-users-gear"></i></a>
								</div>
							</div>
						</li>
						<hr>
						<li>
							<div class="d-flex justify-content-between align-items-center">
								<a href="{{ route('category#list') }}"><i class="fas fa-chart-bar"></i>Categories</a> <span class="plus"><i class="fa-solid fa-plus cursor-pointer"></i></span>
							</div>
							<div class="ps-3 secToogle">
								<div class="d-flex align-items-center">
									<i class="nested-branch me-1"></i>
									<a href="{{ route('category#create') }}">Create Category</a>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex justify-content-between align-items-center">
								<a href="{{ route('products#list') }}"><i class="fa-solid fa-pizza-slice"></i>Products</a> <span class="plus"><i class="fa-solid fa-plus cursor-pointer"></i></span>
							</div>
							<div class="ps-3 thirdToggle">
								<div class="d-flex align-items-center">
									<i class="nested-branch me-1"></i>
									<a href="{{ route('products#create') }}">Create Product</a>
								</div>
							</div>
						</li>
						<li>
							<div class="d-flex justify-content-between align-items-center">
								<a href="{{ route('orders#list') }}"><i class="fa-solid fa-table-list"></i>Orders</a>
							</div>
						</li>
						<hr>
						<li>
							<div class="d-flex justify-content-between align-items-center">
								<a href="{{ route('admin#contact') }}"><i class="fas fa-comments"></i>Contact Messages</a>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</aside>
		<!-- END MENU SIDEBAR-->

		<!-- PAGE CONTAINER-->
		<div class="page-container">
			{{-- Header --}}
			<header class="header-desktop">
				<div class="section__content section__content--p30">
					<div class="container-fluid">
						<div class="header-wrap">
							<span class="form-header">
								<h3>Admin Dashboard Pannel</h3>
							</span>
							@yield('form')
							<div class="header-button">
								<div class="account-wrap">
									<div class="account-item clearfix js-item-menu">
										<div class="image ratio ratio-1x1 object-fit-cover">
											<img class="object-fit-cover" src="@if (Auth::user()->image == null) {{ asset('storage/images/profiles/default.svg') }}@else{{ asset('storage/images/profiles/' . Auth::user()->image) }} @endif" />
										</div>
										<div class="content">
											<a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
										</div>
										<div class="account-dropdown js-dropdown">
											<div class="info clearfix" href="hi">
												<div class="image ratio ratio-1x1">
													<a href="{{ route('admin#profile') }}">
														<img class="h-100 object-fit-cover" src="@if (Auth::user()->image == null) {{ asset('storage/images/profiles/default.svg') }}@else{{ asset('storage/images/profiles/' . Auth::user()->image) }} @endif" />
													</a>
												</div>
												<div class="content">
													<h5 class="name">
														<a href="{{ route('admin#profile') }}">{{ Auth::user()->name }}</a>
													</h5>
													<span class="email">
														<a class="text-muted"href="{{ route('admin#profile') }}">{{ Auth::user()->email }}</a>
													</span>
												</div>
											</div>
											<div class="account-dropdown__body">
												<div class="account-dropdown__item">
													<a href="{{ route('admin#profile') }}"> <i class="zmdi zmdi-account"></i>Account</a>
												</div>
												<div class="account-dropdown__item">
													<a href="{{ route('admin#changePassword') }}"> <i class="zmdi zmdi-key"></i>Change Password</a>
												</div>
												<div class="account-dropdown__item">
													<a href="{{ route('admin#lists') }}"> <i class="fa-solid fa-users"></i>Admin List</a>
												</div>
											</div>
											<div class="account-dropdown__footer">
												<form action="{{ route('logout') }}" method="POST">
													@csrf
													<button type="submit" style="width: 100%;text-align:start">
														<a><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
													</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<script>
				function toast(text, color, backgroundColor, borderColor) {
					return Toastify({
						text: text,
						backgroundColor: backgroundColor,
						style: {
							color: color,
							border: "2px solid",
							borderColor: borderColor,
							borderRadius: '.3rem',
						},
						duration: 5000,
						gravity: "bottom",
						position: "right",
						stopOnFocus: true,
						close: true,
					}).showToast();
				}
			</script>
			@yield('content')
		</div>

</body>
<!-- Jquery JS-->
<!-- Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- Vendor JS       -->
<script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

{{-- Link JS --}}
<script src="https://unpkg.com/popper.js@1"></script>
<script src="https://unpkg.com/tippy.js@5"></script>
<script src="https://kit.fontawesome.com/82bc95e25d.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Main JS-->
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>
<script src="{{ asset('admin/js/main.js') }}"></script>
<script src="{{ asset('assets/js/adminMain.js') }}"></script>
@yield('script')

</html>
<!-- end document-->
