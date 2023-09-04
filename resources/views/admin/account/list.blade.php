@extends('admin.layouts.master')
@section('title', 'Account Lists')
@section('form')
	<form method="GET" action="{{ route('admin#lists') }}">
		<div class="input-group">
			<label class="input-group-text" for="search"><i class="fa fa-search"></i></label>
			<input class="form-control input" id="search" name="search" type="search" value="{{ request('search') }}" placeholder="Search something....." required>
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
					<div class="table-data__tool mb-1">
						<div class="table-data__tool-left">
							<div class="overview-wrap">
								<h2 class="title-1">Admin Lists</h2>
							</div>
						</div>
						<div class="table-data__tool-right">
							<button class="roleSort au-btn au-btn-icon au-btn--green au-btn--small">Admin List</button>
						</div>
					</div>
					<div class="d-flex mb-4">
						<div> <i class="far fa-folder-open me-2"></i> <span id="count">{{ $lists->count() }}</span> records found</div>
					</div>
					@if ($lists->isEmpty())
						<h3 class="alert alert-warning text-secondary border-warning mt-5 rounded border p-5 text-center outline">
							@if (request('search'))
								Sorry, we couldn't find any Accounts for your search.
							@endif
						</h3>
					@else
						<div class="table-responsive table-responsive-lg table-responsive-data2">
							<table class="table-data2 table">
								<thead>
									<tr>
										<th>IMG</th>
										<th>Name</th>
										<th>Email</th>
										<th>Gender</th>
										<th>Phone</th>
										<th>Address</th>
									</tr>
								</thead>
								<tbody id="tbody">
									@foreach ($lists as $list)
										<tr class="tr-shadow">
											<td class="col-2">
												<div class="ratio ratio-1x1">
													<img class="img-thumbnail object-fit-cover" src="@if ($list->image == null) {{ asset('storage/images/profiles/default.svg') }}@else{{ asset('storage/images/profiles/' . $list->image) }} @endif">
												</div>
											</td>
											<td class="text-center"><span class="block-email text-center">{{ $list->name }}</span></td>
											<td class="text-warp text-break text-center">{{ $list->email }} </td>
											<td class="text-center">{{ $list->gender }} </td>
											<td class="text-center">{{ $list->phone }} </td>
											<td class="text-center">{{ $list->address }} </td>
											<td>
												<div class="table-data-feature">
													@if ($list->id == Auth::user()->id)
														<a class='disabled cursor-default opacity-50' disabled>
															<button class="item disabled cursor-default" data-tooltip="Delete" disabled>
																<i class="fa-solid fa-user-gear"></i>
															</button>
														</a>
														<a class='disabled cursor-default opacity-50' disabled>
															<button class="item disabled cursor-default" data-tooltip="Delete" disabled>
																<i class="zmdi zmdi-delete"></i>
															</button>
														</a>
													@else
														<form class="edit" method="POST" action="{{ route('admin#roleChange', $list->id) }}" onsubmit="return confirm('Are you sure you want to Change the role?');">
															@csrf
															<input name="role" type="hidden" value="user">
															<button class="item" data-tooltip="Change Role To User" type="submit">
																<i class="fa-solid fa-user-gear"></i>
															</button>
														</form>
														<form class="edit" action="{{ route('admin#delete', $list->id) }}" onsubmit="return confirm('Are you sure you want to Delete the user?');" method="POST">
															@csrf
															<button class="item" data-tooltip="Delete">
																<i class="zmdi zmdi-delete"></i>
															</button>
														</form>
													@endif
												</div>
											</td>
										</tr>
										<tr class="spacer"></tr>
									@endforeach

									@if (session('message'))
										<script>
											toast('{{ session('message') }}', '{{ session('color') }}', '{{ session('backgroundColor') }}', '{{ session('borderColor') }}')
										</script>
									@endif
								</tbody>
							</table>
							<div class="mt-3">
								{{ $lists->appends(request()->query())->links() }}
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
			$('.roleSort').click(function() {
				if ($(this).html() == 'user list') {
					$(this).html('admin list');
					updateURLParameter('sort', 'admin');
					$(".title-1").html("Admin Lists");
					sort('admin');
				} else {
					$(this).html('user list');
					updateURLParameter('sort', 'user');
					$(".title-1").html("User Lists");
					sort('user');
				}
			});


			var currentURL = window.location.href;
			var urlParams = new URLSearchParams(new URL(currentURL).search);
			var sortValue = urlParams.get('sort');

			if (sortValue === 'user') {
				$('.roleSort').html('user list')
				$(".title-1").html("Admin Lists")
				sort('user')
			}


			function updateURLParameter(key, value) {
				var currentURL = window.location.href;
				var url = new URL(currentURL);
				url.searchParams.set(key, value);
				var newURL = url.href;
				window.history.pushState({
					path: newURL
				}, '', newURL);
			}

			function sort(sort) {
				$.ajax({
					type: 'GET',
					url: `/ajax/accounts/${sort}`,
					success: function(response) {
						$("#count").html(response.length)
						if (response.length != 0) {
							tooltip;
							if (sort == 'user') {
								tooltip = 'admin'
							} else {
								tooltip = 'user'
							}
							let list = '';
							for (let i = 0; i < response.length; i++) {
								const item = response[i];
								list += `
                                <tr class="tr-shadow">
                                    <td class="col-2">
                                        <div class="ratio ratio-1x1">
                                        <img class="img-thumbnail object-fit-cover" src="${item.image ? '/storage/images/profiles/' + item.image : '/storage/images/profiles/default.svg'}">
                                        </div>
                                    </td>
                                    <td class="text-center"><span class="block-email text-center">${item.name}</span></td>
                                    <td class="text-warp text-break text-center">${item.email}</td>
                                    <td class="text-center">${item.gender}</td>
                                    <td class="text-center">${item.phone}</td>
                                    <td class="text-center">${item.address}</td>
                                    <td>
                                        ${item.id == {{ Auth::user()->id }} ? `
						                                        <div class='table-data-feature'>
						                                            <a class='disabled cursor-default opacity-50' disabled>
						                                                <button class="item disabled cursor-default" data-tooltip="Delete" disabled>
						                                                    <i class="fa-solid fa-user-gear"></i>
						                                                </button>
						                                            </a>
						                                            <a class='disabled cursor-default opacity-50' disabled>
						                                                <button class="item disabled cursor-default" data-tooltip="Delete" disabled>
						                                                    <i class="zmdi zmdi-delete"></i>
						                                                </button>
						                                            </a>
						                                        </div>` : `
						                                        <div class="table-data-feature">
						                                            <form class="edit" method="POST" action="/admin/role/change/${item.id}" onsubmit="return confirm('Are you sure you want to change the role?');">
						                                                {{ csrf_field() }}
						                                                <input name="role" type="hidden" value="${tooltip}">
						                                                <button class="item" data-tooltip="Change Role To ${tooltip}" type="submit">
						                                                    <i class="fa-solid fa-user-gear"></i>
						                                                </button>
						                                            </form>
						                                            <form class="edit" action="/admin/delete/${item.id}" onsubmit="return confirm('Are you sure you want to Delete the user?');" method="POST">
						                                                {{ csrf_field() }}
						                                                <button class="item" data-tooltip="Delete">
						                                                    <i class="zmdi zmdi-delete"></i>
						                                                </button>
						                                            </form>
						                                        </div>`}
                                    </td>
                                </tr>
                                <tr class = "spacer"></tr>`
							}
							$("#tbody").html(list)
							tooltip = document.querySelectorAll(".item");
							tooltip.forEach((item) => {
								tippy(item, {
									content: item.getAttribute("data-tooltip"),
									animation: "shift-toward",
									arrowType: "round",
								});
							});
						} else {
							$("#tbody").html(`
                                <tr class="text-center">
                                    <td colspan="6">
                                        No Account Found.
                                    </td>
                                </tr>
                            `)
						}
					}
				})
			}
		})
	</script>
@endsection
