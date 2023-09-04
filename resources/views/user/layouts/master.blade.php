<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="Free HTML Templates">
	<meta name="description" content="Free HTML Templates">
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<!-- Favicon -->
	<link href="img/favicon.ico" rel="icon">

	<!-- Google Web Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- Libraries Stylesheet -->
	<link href="{{ asset('user/lib/animate/animate.min.css') }}" rel="stylesheet">
	<link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

	<!-- Customized Bootstrap Stylesheet -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
	<link type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
	<link href="https://unpkg.com/tippy.js@5.2.1/dist/backdrop.css" rel="stylesheet">
	<link href="https://unpkg.com/tippy.js@5.2.1/animations/shift-toward.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com" rel="preconnect">
	<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@1,300&display=swap" rel="stylesheet">

</head>

<style>
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* Firefox */
	input[type=number] {
		-moz-appearance: textfield;
	}

	.user-info {
		display: grid;
		grid-template-columns: 120px auto;
		row-gap: 1.5rem;
	}

	.label {
		font-size: 13px;
		color: #666;
	}

	.value {
		font-size: 16px;
		color: #333;
		display: flex;
		justify-content: space-between;
		cursor: pointer;
		font-weight: 500;
	}

	.value>*,
	td .icon,
	.description-hover .icon {
		transition: .3s all;
	}

	.underLine {
		position: relative;
		display: flex;
		justify-content: center;
	}

	.underLine::after {
		content: "";
		display: block;
		margin: 0 auto;
		position: absolute;
		top: 97%;
		width: 0;
		height: 2px;
		background-color: black;
		transition: .3s all;
	}

	.value:hover .underLine::after {
		width: 100%
	}

	.value div,
	td .icon,
	.description-hover .icon {
		opacity: 0;
		transform: translateY(-10px);
		color: #333
	}

	td .d-flex {
		justify-content: space-between;
		cursor: pointer;
	}

	.value:hover div,
	td:hover .icon,
	.description-hover:hover .icon {
		transform: translateY(0);
		opacity: 1;
	}

	a {
		text-decoration: none !important;
	}

	img {
		user-drag: none;
		-webkit-user-drag: none;
		user-select: none;
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}

	.delete:hover .item,
	.edit:hover .item,
	.view:hover .item {
		background-color: #3d3d3d;
	}

	.backBtn {
		overflow: hidden;
	}

	.backBtn i {
		transition: .3s;
		text-shadow: 2.2rem 0 0 rgb(0, 0, 0);
	}

	.backBtn:hover i {
		transform: translateX(-2.2rem);
		color: rgba(0, 0, 0, 0);
	}

	td {
		padding-left: 2rem;
	}

	.cursor-pointer {
		cursor: pointer !important;
	}

	.cursor-default {
		cursor: default !important;
	}

	textarea::-webkit-scrollbar {
		width: 5px;
		cursor: pointer !important
	}

	textarea::-webkit-scrollbar-track {
		background-color: #ffffff00;
	}

	textarea::-webkit-scrollbar-track:hover {
		background-color: #ffffff00;
	}

	textarea::-webkit-scrollbar-track:active {
		background-color: #eaeaea;
	}

	textarea::-webkit-scrollbar-thumb {
		border-radius: 6px;
		background-color: #797979;
	}

	.alertDot {
		width: 1.8rem;
		box-sizing: unset;
		height: 1.8rem;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.lineHr {
		width: 100%;
		height: 1px;
		background-color: #ffc100;
		margin-bottom: 1rem
	}

	.dollaFont {
		font-family: 'Kanit', sans-serif !important;
	}

	.cartWarning {
		display: none;
	}

	lord-icon {
		display: flex;
	}
</style>

<body>
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
				close: false,
			}).showToast();
		}
	</script>
	<!-- Navbar Start -->
	<div class="container-fluid bg-dark mb-30 py-3">
		<div class="row align-items-center">
			<div class="col d-none d-lg-block">
				<a class="text-decoration-none" href="/">
					<span class="h1 text-uppercase text-primary bg-dark px-2">My</span>
					<span class="h1 text-uppercase text-dark bg-primary ml-n1 px-2">Shop</span>
				</a>
			</div>
			<div class="col">
				<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-lg-0 py-3 px-0">
					<a class="text-decoration-none d-block d-lg-none" href="">
						<span class="h1 text-uppercase text-dark bg-light px-2">My</span>
						<span class="h1 text-uppercase text-light bg-primary ml-n1 px-2">Shop</span>
					</a>
					<button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" type="button">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="navbar-collapse justify-content-center collapse" id="navbarCollapse">
						<div class="navbar-nav">
							<a class="nav-item nav-link {{ request()->is('user/home') ? 'active' : '' }}" href="{{ route('user#home') }}">Home</a>
							<a class="nav-item nav-link {{ request()->is('user/cart') ? 'active' : '' }}" href="{{ route('user#cart') }}">Cart</a>
							<a class="nav-item nav-link {{ request()->is('user/history') ? 'active' : '' }}" href="{{ route('user#history') }}">Order History</a>
							<a class="nav-item nav-link {{ request()->is('user/contact') ? 'active' : '' }}" href="{{ route('user#contact') }}">Contact</a>
						</div>
					</div>
				</nav>
			</div>
			<div class="navbar-nav col d-none d-lg-flex ml-auto py-0" style="z-index: 100000000000000">
				<div class="d-flex justify-content-end pe-5 align-items-center ml-2">
					<div class="dropdown-toggle btn btn-outline-light rounded" data-toggle="dropdown" type="button">
						<i class="fa fa-user"></i> <span class="ms-2">{{ Auth::user()->name }}</span>
					</div>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{ route('user#profile') }}">
							<i class="fa-solid fa-user mr-2"></i>Account
						</a>
						<a class="dropdown-item my-3 py-2" href="{{ route('user#changePassword') }}">
							<i class="fa-solid fa-key mr-2"></i>Change Password
						</a>
						<hr class="dropdown-divider">
						<form class="dropdown-item d-flex justify-content-center" method="POST" action="{{ route('logout') }}">
							@csrf
							<button class="btn btn-outline-warning d-flex align-items-center rounded" type="submit"><span class="mr-2">Logout</span> <i class="fa-solid fa-arrow-right-from-bracket"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Navbar End -->
	@yield('content')
	</div>
	</div>
	<!-- Shop End -->





	<!-- Footer Start -->
	<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
		<div class="row px-xl-5 pt-5">
			<div class="col-lg-4 col-md-12 pr-xl-5 mb-5 pr-3">
				<h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
				<p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
				<p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
				<p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
				<p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
			</div>
			<div class="col-lg-8 col-md-12">
				<div class="row">
					<div class="col-md-4 mb-5">
						<h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
						<div class="d-flex flex-column justify-content-start">
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
							<a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
						</div>
					</div>
					<div class="col-md-4 mb-5">
						<h5 class="text-secondary text-uppercase mb-4">My Account</h5>
						<div class="d-flex flex-column justify-content-start">
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
							<a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
							<a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
						</div>
					</div>
					<div class="col-md-4 mb-5">
						<h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
						<p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
						<form action="">
							<div class="input-group">
								<input class="form-control" type="text" placeholder="Your Email Address">
								<div class="input-group-append">
									<button class="btn btn-primary">Sign Up</button>
								</div>
							</div>
						</form>
						<h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
						<div class="d-flex">
							<a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
							<a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
							<a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
							<a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
			<div class="col-md-6 px-xl-0">
				<p class="mb-md-0 text-md-left text-secondary text-center">
					&copy; <a class="text-primary" href="#">Domain</a>. All Rights Reserved. Designed
					by
					<a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
				</p>
			</div>
			<div class="col-md-6 px-xl-0 text-md-right text-center">
				<img class="img-fluid" src="/user/img/payments.png" alt="">
			</div>
		</div>
	</div>
	<!-- Footer End -->


	<!-- Back to Top -->
	<a class="btn btn-primary back-to-top" href="#" style="z-index:100"><i class="fa fa-angle-double-up"></i></a>


</body>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/82bc95e25d.js" crossorigin="anonymous"></script>
<script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
<script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Contact Javascript File -->
<script src="{{ asset('user/mail/jqBootstrapValidation.min.js') }}"></script>
<script src="{{ asset('user/mail/contact.js') }}"></script>
<script src="https://unpkg.com/popper.js@1"></script>
<script src="https://unpkg.com/tippy.js@5"></script>


<!-- Template Javascript -->
<script src="{{ asset('user/js/main.js') }}"></script>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>
@yield('script')

</html>
