@extends('user.layouts.master')
@section('title', 'Cart')
@section('content')
	<div class="container-fluid" id='main'>
		<div class="row px-xl-5">
			<div class="col-lg-8 table-responsive mb-5">
				<table class="table-light table-borderless table-hover mb-0 table text-center">
					<thead class="thead-dark sticky-top">
						<tr>
							<th></th>
							<th>Products</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Total</th>
							<th>Remove</th>
						</tr>
					</thead>
					<tbody class="align-middle" style="min-height: 50px">
						<input id="userId" type="hidden" value='{{ Auth::user()->id }}'>
						@if ($carts->isEmpty())
							<tr class="py-5">
								<td class="py-5 text-center" colspan="6">
									<lord-icon class="mx-auto" src="https://cdn.lordicon.com/udbbfuld.json" style="width:250px;height:250px" delay="500" trigger="loop" colors="primary:#121331">
									</lord-icon>
									<p>Your cart is empty</p>
								</td>
							</tr>
						@else
							@foreach ($carts as $cart)
								<tr>
									<input id='cartId' type="hidden" value="{{ $cart->id }}">
									<input id="productId" type="hidden" value="{{ $cart->product_id }}">
									<input class="pizzaPrice" type="hidden" value='{{ $cart->pizzaPrice }}'>
									<td class="align-middle">
										<img class="object-fit-cover" src="{{ asset('storage/images/products/' . $cart->pizzaImg) }}"style="width: 100px;height:70px" />
									</td>
									<td class="align-middle">{{ $cart->pizzaName }}</td>
									<td class="dollaFont align-middle">$ {{ $cart->pizzaPrice }}</td>
									<td class="align-middle">
										<div class="input-group quantity mx-auto" style="width: 100px">
											<div class="input-group-btn">
												<button class="btn btn-sm btn-primary btn-minus">
													<i class="fa fa-minus"></i>
												</button>
											</div>
											<input class="form-control form-control-sm bg-secondary qty border-0 text-center" type="number" value="{{ $cart->qty }}" pattern="\d+" min='0' />
											<div class="input-group-btn">
												<button class="btn btn-sm btn-primary btn-plus">
													<i class="fa fa-plus"></i>
												</button>
											</div>
										</div>
									</td>
									<td class="w-25 align-middle">
										<input class="form-control form-control-sm fs-5 totalAsign dollaFont mx-auto border-0 bg-transparent text-center" id='totalAsign' type="text" value="$ {{ $cart->pizzaPrice * $cart->qty }}" readonly>
									</td>
									<td class="align-middle">
										<button class="btn btn-sm btn-danger remove">
											<i class="fa fa-times"></i>
										</button>
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="col-lg-4 sticky-top" style="height:fit-content;top:5%">
				<h5 class="section-title position-relative text-uppercase mb-3">
					<span class="bg-secondary pr-3">Cart Summary</span>
				</h5>
				<div class="row">
					<div class="col">
						<div class="bg-light p-30 mb-3">
							<div class="border-bottom pb-2">
								<div class="d-flex justify-content-between mb-3">
									<h6>Subtotal</h6>
									<h6 class="dollaFont fs-4" id="subTotal">$ {{ $total }}</h6>
								</div>
								<div class="d-flex justify-content-between">
									<h6 class="font-weight-medium">Delivery Fees</h6>
									<h6 class="font-weight-medium dollaFont fs-4" id="delifee">
										$ {{ $total == 0 ? 0 : 5 }}
									</h6>
								</div>
							</div>
							<div class="pt-2">
								<div class="d-flex justify-content-between mt-2">
									<h5>Total</h5>
									<h5 class="dollaFont fs-4" id="checkoutTotal">$ {{ $total == 0 ? $total : $total + 5 }}</h5>
								</div>
								<button class="btn d-flex align-items-center justify-content-center btn-block btn-primary font-weight-bold my-3 rounded py-3" id='checkoutBtn'>
									Place Order
									<lord-icon src="https://cdn.lordicon.com/hyhnpiza.json" trigger="hover" colors="primary:#121331">
									</lord-icon>
								</button>
								<div class="text-danger cartWarning">
									You need at least 1 item in your cart to place order.
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col px-30">
						<button class="btn d-flex justify-content-center align-items-center btn-block btn-danger font-weight-bold my-3 rounded py-3" id="clearCart">
							Clear Cart
							<lord-icon src="https://cdn.lordicon.com/kfzfxczd.json" trigger="hover" colors="primary:#ffffff">
							</lord-icon>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{ asset('assets/js/cart.js') }}"></script>
@endsection
