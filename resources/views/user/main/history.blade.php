@extends('user.layouts.master')
@section('title', 'Order History')
@section('content')
	<div class="container-fluid" id='main'>
		<div class="row px-xl-5 justify-content-center">
			<div class="col-lg-8 table-responsive mb-5">
				<table class="table-light table-borderless table-hover mb-0 table text-center">
					<thead class="thead-dark sticky-top">
						<tr>
							<th>Date</th>
							<th>Order Id</th>
							<th>Total Price</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody class="align-middle">
						@foreach ($lists as $list)
							<tr>
								<td class="align-middle"style="width:20%">
									<div class="date-container d-flex flex-column justify-content-center align-items-center">
										<div>
											{{ $list->created_at->diffForHumans() }}
										</div>
										<div style="display:none">
											{{ $list->created_at->format('M d, Y') }}
										</div>
									</div>
								</td>
								<td class="border-right-0 border-bottom-0 border align-middle">{{ $list->order_code }}</td>
								<td class="border-bottom-0 border align-middle">{{ $list->total_price }} $</td>
								<td class="border-right-0 border-bottom-0 border align-middle" style="width:15%">
									@if ($list->status == 0)
										<div class="text-warning d-flex align-items-center">
											<lord-icon src="https://cdn.lordicon.com/qznlhdss.json" style="width:25px" delay="500" trigger="hover" colors="primary:#FF8C00">
												<div class="d-block ms-4" style="transform: translate(4px,4px);">
													Pending
												</div>
											</lord-icon>
										</div>
									@elseif($list->status == 1)
										<div class="text-success d-flex align-items-center">
											<lord-icon src="https://cdn.lordicon.com/yqzmiobz.json" style="width:25px" trigger="hover" colors="primary:#28a745">
												<div class="d-block ms-4" style="transform: translate(4px,3px);">
													Success
												</div>
											</lord-icon>
										</div>
									@elseif($list->status == 2)
										<div class="text-danger d-flex align-items-center">
											<lord-icon class="text-danger" src="https://cdn.lordicon.com/wdqztrtx.json" style="width:25px" trigger="hover" colors="primary:#dc3545">
												<div class="d-block ms-4" style="transform: translate(4px,3px);">
													Reject
												</div>
											</lord-icon>
										</div>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{ asset('assets/js/history.js') }}"></script>
@endsection
