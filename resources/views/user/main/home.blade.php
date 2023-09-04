@extends('user.layouts.master')
@section('title', 'Home')
@section('content')
	<!-- Shop Start -->
	<div class="container-fluid pt-5">
		<div class="row px-xl-5">
			<!-- Shop Sidebar Start -->
			<div class="col-lg-3 sticky-top col-md-4" style="height:fit-content; top:5%">
				<!-- Price Start -->
				<h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Category</span></h5>
				<div class="bg-light mb-30 p-4">
					<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
						<label class="btn active rounded" id="allCategory" onclick="window.location='{{ route('user#home') }}'">All Category</label>
						<span class="badge font-weight-normal text-muted border">{{ $pizzaCount }}</span>
					</div>
					<hr>
					@foreach ($category as $c)
						<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
							<label class="w-75">
								<div class="btn rounded text-left filter" data-categoryId="{{ $c->id }}">{{ $c->name }}</div>
							</label>
							<span class="badge font-weight-normal text-muted border">{{ $c->products_count }}</span>
						</div>
					@endforeach
				</div>
				<!-- Price End -->
			</div>
			<!-- Shop Sidebar End -->

			<!-- Shop Product Start -->
			<div class="col-lg-9 col-md-8">
				<div class="row pb-3">
					<div class="col-12 pb-1">
						<div class="d-flex align-items-center justify-content-between mb-4">
							<div>
								<a href="{{ route('user#cart') }}">
									<button class="position-relative btn border-dark-subtle border-1 btn-light rounded">
										<i class="fa-solid fa-cart-shopping me-2"></i>
										Cart
										<span class="position-absolute alertDot start-100 translate-middle bg-dark rounded-circle top-0 text-white">
											<span class="visually-hidden">New alerts</span>
											{{ count($cart) }}
										</span>
									</button>
								</a>

								<a class="ms-3" href="{{ route('user#history') }}">
									<button class="position-relative btn border-dark-subtle border-1 btn-light rounded">
										<i class="fa-solid fa-clock-rotate-left me-2"></i>
										Order History
										<span class="position-absolute alertDot start-100 translate-middle bg-success rounded-circle top-0 text-white">
											<span class="visually-hidden">New alerts</span>
											{{ count($orderCount) }}
										</span>
									</button>
								</a>
							</div>
							<div class="ml-2">
								<select class="form-select" id="sorting" name="sorting">
									<option value="asc">Ascending</option>
									<option value="desc" selected>Descending</option>
								</select>
							</div>
						</div>
					</div>
					<hr>
					<div class="row" id="product">
						@if ($pizzas->isEmpty())
							<div class="w-100 h-100 d-flex justify-content-center align-items-center">
								<div class="alert alert-info d-flex align-items-center justify-content-center py-4" role="alert">
									<span class="material-icons mr-4" style="font-size: 3rem;user-select: none;">sentiment_neutral</span>
									<div>
										<h4 class="alert-heading mb-3">No Products Found</h4>
										<p class="mb-0">Sorry, there are no products in this category yet. Please check back later or contact the site <br> administrator for assistance.</p>
									</div>
								</div>
							</div>
						@else
							@foreach ($pizzas as $pizza)
								<div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="product">
									<div class="product-item bg-light mb-4">
										<div class="product-img position-relative overflow-hidden">
											<img class="img-fluid w-100 object-fit-cover" src="{{ asset('storage/images/products/' . $pizza->image) }}" style="height:270px">
											<div class="product-action">
												<a class="btn btn-outline-dark btn-square" href="{{ route('product#detail', $pizza->id) }}"><i class="fa-solid fa-circle-info"></i></a>
											</div>
										</div>
										<div class="position-relative py-4 text-center">
											<a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name }}</a>
											<div class="d-flex align-items-center justify-content-center mt-2">
												<h5>{{ $pizza->price }} $</h5>
											</div>
											<small class="position-absolute end-0 pe-2 bottom-0 pb-1">View Count {{ $pizza->view_count }}</small>
										</div>
									</div>
								</div>
							@endforeach
						@endif
					</div>
				</div>
				<div class="mt-1">
					{{ $pizzas->appends(request()->query())->links() }}
				</div>
			</div>
			<!-- Shop Product End -->
		</div>
	</div>
@endsection

@section('script')
	<script src='{{ asset('assets/js/home.js') }}'></script>
@endsection
