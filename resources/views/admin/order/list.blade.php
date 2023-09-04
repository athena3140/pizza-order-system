@extends('admin.layouts.master')
@section('title', 'Order Lists')
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
					<div class="row align-items-center mb-3">
						<div class="col">
							<div class="table-data__tool mb-1">
								<div class="table-data__tool-left">
									<div class="overview-wrap">
										<h2 class="title-1">Order Lists</h2>
									</div>
								</div>
							</div>
							<div class="d-flex mb-4">
								<div> <i class="far fa-folder-open me-2"></i> {{ $orders->count() }} records found</div>
							</div>
						</div>
						<div class="col-2">
							<label class="label d-block" for="statusSort">Status Sort</label>
							<select class="form-control focus-ring form-select rounded" id="statusSort">
								<option value="default text-black">Default</option>
								<option class="text-warning" value="0">Pending</option>
								<option class="text-success" value="1">Success</option>
								<option class="text-danger" value="2">Reject</option>
							</select>
						</div>
						<div class="col-1">
							<label class="label d-block">Asc/Desc</label>
							<div class="form-check m-0">
								<input class="form-check-input" id="ascRadio" name="order" type="radio" value="asc">
								<label class="form-check-label cursor-pointer" for="ascRadio">Asc</label>
							</div>
							<div class="form-check m-0">
								<input class="form-check-input" id="descRadio" name="order" type="radio" value="desc" checked>
								<label class="form-check-label cursor-pointer" for="descRadio">Desc</label>
							</div>
						</div>
					</div>
					@if ($orders->isEmpty())
						<h3 class="alert alert-warning text-secondary border-warning mt-5 rounded border p-5 text-center outline">
							@if (request('search'))
								Sorry, no orders found.
							@else
								No one has placed an order yet.
							@endif
						</h3>
					@else
						<div class="table-responsive table-responsive-data2">
							<table class="table-data2 table">
								<thead>
									<tr>
										<th>Order Id</th>
										<th>User Name</th>
										<th>Order Code</th>
										<th>Total Price</th>
										<th>Date</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody id="tbody">
									@foreach ($orders as $order)
										<tr class="tr-shadow">
											<td class="text-center">{{ $order->id }}</td>
											<td class="text-center">{{ $order->user_name }}</td>
											<td class="text-center">
												<a class="copy link-opacity-75-hover cursor-pointer" data-tooltip="Click for more details." href='{{ route('orders#orderIdList', $order->order_code) }}'>
													{{ $order->order_code }}
												</a>
											</td>
											<td class="text-center">{{ $order->total_price }} &#36;</td>
											<td class="text-center">{{ $order->created_at->format('M d, Y') }}</td>
											<td class="text-center">
												<select class="form-control statusTD focus-ring @if ($order->status == 0) text-warning focus-ring-warning border-warning @elseif($order->status == 1) text-success focus-ring-success border-success @else focus-ring-danger text-danger border-danger @endif form-select cursor-pointer rounded">
													<option class="text-warning" value="0" @if ($order->status == 0) selected @endif>Pending</option>
													<option class="text-success" value="1" @if ($order->status == 1) selected @endif>Success</option>
													<option class="text-danger" value="2" @if ($order->status == 2) selected @endif>Reject</option>
												</select>
											</td>
										</tr>
										<tr class="spacer"></tr>
									@endforeach
								</tbody>
							</table>
							<div class="mt-3">
								{{ $orders->appends(request()->query())->links() }}
							</div>
						</div>
						<!-- END DATA TABLE -->
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection


@section('script')
	<script>
		$(document).ready(function() {

			$("#statusSort").change(function() {
				status = $("#statusSort").val()
				var noneMsg;
				$(this).removeClass('text-success focus-ring-success border-success focus-ring-danger border-danger text-danger focus-ring-warning border-warning text-warning');

				if (status == 0) {
					$(this).addClass('focus-ring-warning border-warning text-warning');
					noneMsg = 'pending'
				} else if (status == 1) {
					$(this).addClass('text-success focus-ring-success border-success');
					noneMsg = 'success'
				} else if (status == 2) {
					$(this).addClass('focus-ring-danger border-danger text-danger');
					noneMsg = 'reject'
				}
				$.ajax({
					url: `/ajax/status/sort/${status}`,
					type: 'get',
					success: function(response) {
						if (response.length != 0) {
							let data = '';
							for (let i = 0; i < response.length; i++) {
								const order = response[i];
								const formattedDate = new Date(order.created_at).toLocaleDateString("en-US", {
									month: "short",
									day: "numeric",
									year: "numeric"
								});
								data += `
	                                <tr class="tr-shadow">
	                                <td class="text-center">${order.id}</td>
	                                <td class="text-center"> ${order . user_name} </td>
	                                <td class="text-center">
	                                    <span class="copy block-email cursor-pointer" data-tooltip="Click for more details.">
	                                    ${order.order_code}
	                                    </span>
	                                </td>
	                                <td class="text-center">${order.total_price} &#36;</td>
	                                <td class="text-center">${formattedDate}</td>
	                                <td class="text-center">
	                                    <select class="cursor-pointer statusTD form-control focus-ring ${order.status === 0 ? 'text-warning focus-ring-warning border-warning' : (order.status === 1 ? 'text-success focus-ring-success border-success' : 'text-danger focus-ring-danger border-danger')} form-select rounded">
	                                    <option class="text-warning" value="0" ${order.status === 0 ? 'selected' : ''}>Pending</option>
	                                    <option class="text-success" value="1" ${order.status === 1 ? 'selected' : ''}>Success</option>
	                                    <option class="text-danger" value="2" ${order.status === 2 ? 'selected' : ''}>Reject</option>
	                                    </select>
	                                </td>
	                                </tr>
	                                <tr class="spacer"></tr>
	                            `;
							}
							$("#tbody").html(data);
							$('.statusTD').change(function() {
								changeStatus($(this));
							});
							tippy(".copy", {
								content: $(".copy").attr("data-tooltip"),
								animation: "shift-toward",
								arrowType: "round",
							});
							$('input[name="order"][value="desc"]').prop('checked', true);
						} else {
							$("#tbody").html(`
                                <tr class="text-center">
                                    <td colspan="6">
                                        There is no ${noneMsg} order.
                                    </td>
                                </tr>
                            `);
						}
					}
				});
			})


			$(".copy").click(function() {
				var e = $(this).text().trim(),
					t = $("<input>");
				t.val(e), $("body").append(t), t[0].setSelectionRange(0, t.val().length), t[0].addEventListener("focus", function() {
					t[0].setSelectionRange(0, t.val().length);
					try {
						document.execCommand("copy")
					} catch (e) {
						console.error("Unable to copy order code.", e)
					}
					t.remove()
				}), t.trigger("focus")
			});

			function reverseArray(arr) {
				return Array.prototype.reverse.call(arr);
			}

			$('input[name="order"]').change(function() {
				var children = $("#tbody").children();
				if ($(this).val() == "desc") {
					reverseArray(children).hide().appendTo("#tbody").fadeIn();
					$(".spacer:first-child").remove()
				} else {
					reverseArray(children).hide().appendTo("#tbody").fadeIn();
					$(".spacer:first-child").remove()
				}
			});


			$('.statusTD').change(function() {
				changeStatus($(this));
			});

			function changeStatus(element) {
				var status = element.val();
				var orderId = element.parents('tr').find('.text-center:first-child').html()
				element.removeClass('text-success focus-ring-success border-success focus-ring-danger border-danger text-danger focus-ring-warning border-warning text-warning');
				if (status == 0) {
					element.addClass('focus-ring-warning border-warning text-warning');
				} else if (status == 1) {
					element.addClass('text-success focus-ring-success border-success');
				} else if (status == 2) {
					element.addClass('focus-ring-danger border-danger text-danger');
				}

				$.ajax({
					type: 'PUT',
					url: `/ajax/orders/${orderId}/status/${status}`,
					success: function(response) {
						toast(response.message, "#ffffff", "#28a745", "#279e3c");
					},
				})
			}

		})
	</script>
@endsection
