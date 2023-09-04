@extends('admin.layouts.master')
@section('title', 'Order Info')
@section('form')
	<form method="GET" action="{{ route('orders#list') }}">
		<div class="input-group">
			<label class="input-group-text" for="search"><i class="fa fa-search"></i></label>
			<input class="form-control input" id="search" name="search" type="search" value="{{ request('search') }}" placeholder="Search something.....">
			<button class="btn btn-outline-secondary" type="submit">Search</button>
		</div>
	</form>
@endsection
@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="col-md-12 mb-5 pb-5">
					<!-- DATA TABLE -->
					<div class="row">
						<div class="col">
							<div class="table-data__tool mb-1">
								<div class="table-data__tool-left">
									<div class="overview-wrap">
										<h2 class="title-1">Order Lists</h2>
									</div>
								</div>
							</div>
							<div class="d-flex">
								<div> <i class="far fa-folder-open me-2"></i>{{ $orders->count() }} records found</div>
							</div>
							<button class="backBtn my-1" onclick="javascript:history.back()">
								<i class="fa-solid fa-arrow-left fs-4"></i>
							</button> Back
						</div>
						<div class="col-6">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Order Info</h5>
									<hr>
									<div class="row">
										<p class="card-text col-4">Name :</p>
										<div class="col">
											<span class="bg-warning-subtle px-1">{{ $orders[0]->user_name }}</span>
										</div>
									</div>
									<div class="row">
										<p class="card-text col-4">Order Code : </p>
										<div class="col">
											<span class="bg-warning-subtle px-1">{{ $orders[0]->order_code }}
											</span>
										</div>
									</div>
									<div class="row">
										<p class="card-text col-4">Item Count : </p>
										<div class="col">
											<span class="bg-warning-subtle px-1">{{ $orders->count() }}</span>
										</div>
									</div>
									<div class="row">
										<p class="card-text col-4">Subtotal :</p>
										<div class="col">
											<span class="bg-warning-subtle px-1">{{ number_format($subtotal, 0, ',', ',') }} &#36;</span>
										</div>
									</div>
									<div class="row">
										<p class="card-text col-4">Deli Fee :</p>
										<div class="col">
											<span class="bg-warning-subtle px-1">{{ number_format($totalPrice - $subtotal, 0, ',', ',') }} &#36;</span>
										</div>
									</div>
									<hr class="my-2">
									<div class="row">
										<p class="card-text col-4">Total :</p>
										<div class="col">
											<span class="bg-warning-subtle px-1">{{ number_format($totalPrice, 0, ',', ',') }} &#36;</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="table-responsive table-responsive-data2">
						<table class="table-data2 table">
							<thead>
								<tr>
									<th>User Name</th>
									<th>Product</th>
									<th>Price</th>
									<th></th>
									<th>Quantity</th>
									<th></th>
									<th>Total Price</th>
									<th>Order Date</th>
								</tr>
							</thead>
							<tbody id="tbody">
								@foreach ($orders as $order)
									<tr class="tr-shadow">
										<td class="text-center" style="border-right:1px solid">{{ $order->user_name }}</td>
										<td class="text-center">{{ $order->product_name }}</td>
										<td class="text-center">{{ $order->product_price }} &#36;</td>
										<td>&#215;</td>
										<td class="text-center">{{ $order->qty }} </td>
										<td>&#61;</td>
										<td class="text-center">{{ $order->total }} &#36;</td>
										<td class="text-center" style="border-left:1px solid">{{ $order->created_at->format('M d, Y') }} </td>
									</tr>
									<tr class="spacer"></tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
