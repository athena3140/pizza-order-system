@extends('user.layouts.master')
@section('title')
	{{ $product->name }}
@endsection
@section('content')
	<!-- Shop Detail Start -->
	<div class="container-fluid pb-5">
		<div class="row">
			<div class="col-5 px-xl-5">
				<button class="backBtn btn overflow-hidden" style="width:fit-content" onclick="javascript:window.location.href ='{{ route('user#home') }}'; ">
					<i class="fa-solid fa-arrow-left fs-4"></i>
				</button>
			</div>
		</div>
		<div class="row px-xl-5">
			<div class="col-lg-5 mb-30">
				<div class="carousel slide" id="product-carousel" data-ride="carousel">
					<div class="carousel-inner bg-light">
						<div class="carousel-item active">
							<img class="w-100 h-100" src="{{ asset('storage/images/products/' . $product->image) }}" alt="Image">
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-7 mb-30 h-auto">
				<div class="h-100 bg-light p-30">
					<h3>{{ $product->name }}</h3>
					<div class="d-flex mb-3">
						<small class="pt-1">{{ $product->view_count + 1 }} Times Viewed</small>
					</div>
					<h3 class="font-weight-semi-bold mb-4">{{ $product->price }} $</h3>
					<p class="mb-4">{{ $product->description }}</p>
					<hr>
					<div class="d-flex align-items-center mb-4 pt-2">
						<div class="input-group quantity mr-3" style="width: 130px;">
							<div class="input-group-btn">
								<button class="btn btn-primary btn-minus">
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<input class="form-control bg-secondary border-0 text-center" id='pizzaCount' type="text" value="1">
							<div class="input-group-btn">
								<button class="btn btn-primary btn-plus">
									<i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
						<button class="btn btn-primary px-3" id='addToCart' type="button"><i class="fa fa-shopping-cart mr-1"></i> Add To
							Cart</button>
					</div>
					<div class="d-flex pt-2">
						<strong class="text-dark mr-2">Share on:</strong>
						<div class="d-inline-flex">
							<a class="text-dark px-2" href="">
								<i class="fab fa-facebook-f"></i>
							</a>
							<a class="text-dark px-2" href="">
								<i class="fab fa-twitter"></i>
							</a>
							<a class="text-dark px-2" href="">
								<i class="fab fa-linkedin-in"></i>
							</a>
							<a class="text-dark px-2" href="">
								<i class="fab fa-pinterest"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Shop Detail End -->


	<!-- Products Start -->
	<div class="container-fluid py-5">
		<h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
		<div class="row px-xl-5">
			<div class="col">
				<div class="owl-carousel related-carousel">
					@foreach ($pizzas as $p)
						<div class="product-item bg-light">
							<div class="product-img position-relative overflow-hidden">
								<img class="img-fluid w-100 object-fit-cover" src="{{ asset('storage/images/products/' . $p->image) }}" alt="" style="height:200px">
								<div class="product-action">
									<a class="btn btn-outline-dark btn-square" href="{{ route('product#detail', $p->id) }}"><i class="fa-circle-info fa"></i></a>
								</div>
							</div>
							<div class="py-4 text-center">
								<a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
								<div class="d-flex align-items-center justify-content-center mt-2">
									<h5>{{ $p->price }}$</h5>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- Products End -->
	<input id="userId" name="id" type="hidden" value="{{ Auth::user()->id }}">
	<input id="pizzaId" name="pizza" type="hidden" value="{{ $product->id }}">
@endsection

@section('script')
	<script src='{{ asset('assets/js/detail.js') }}'></script>
@endsection
