@extends('admin.layouts.master')
@section('title')
	{{ $pizza->name }}
@endsection

@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid d-flex justify-content-center align-items-center flex-column">
				<div class="col-lg-12 rounded bg-white p-5">
					<button class="backBtn" onclick="javascript:history.back()"><i class="fa-solid fa-arrow-left fs-4"></i></button>
					<div class="col-md-12">
						<div class="row mt-3">
							<div class="row">
								<div class="col-5">
									<div class="ratio ratio-1x1">
										<img class="img-thumbnail object-fit-cover cursor-pointer" id="profileImg" data-tooltip="Click To View Image." data-bs-toggle="modal" data-bs-target="#exampleModal" src="{{ asset('storage/images/products/' . $pizza->image) }}">
									</div>
								</div>
								<div class="col ps-4">
									<table class="w-100 h-100">
										<tbody>
											<tr>
												<th><small class="label">Name :</small></th>
												<td>
													<a class="d-flex" href="{{ route('products#edit', $pizza->id) }}?key=name">
														<h4>{{ $pizza->name }}</h4>
														<div class="icon text-right">
															<i class="fa-solid fa-pen-to-square"></i>
														</div>
													</a>
												</td>
											</tr>
											<tr>
												<th><small class="label">Category :</small></th>
												<td>
													<a class="d-flex" href="{{ route('products#edit', $pizza->id) }}?key=category">
														<h4>{{ $pizza->categoryName }}</h4>
														<div class="icon text-right">
															<i class="fa-solid fa-pen-to-square"></i>
														</div>
													</a>
												</td>
											</tr>
											<tr>
												<th><small class="label">Waiting-Time :</small></th>
												<td>
													<a class="d-flex" href="{{ route('products#edit', $pizza->id) }}?key=waitingTime">
														<h4>{{ $pizza->waiting_time }} min</h4>
														<div class="icon text-right">
															<i class="fa-solid fa-pen-to-square"></i>
														</div>
													</a>
												</td>
											</tr>
											<tr>
												<th><small class="label">Price :</small></th>
												<td>
													<a class="d-flex" href="{{ route('products#edit', $pizza->id) }}?key=price">
														<h4>{{ number_format($pizza->price, 0, '.', ',') }} $</h4>
														<div class="icon text-right">
															<i class="fa-solid fa-pen-to-square"></i>
														</div>
													</a>
												</td>
											</tr>
											<tr>
												<th><small class="label">View Count :</small></th>
												<td>
													<div class="d-flex cursor-default">
														<h4>{{ $pizza->view_count }}</h4>
													</div>
												</td>
											</tr>
											<tr>
												<th><small class="label">Created-at :</small></th>
												<td>
													<div class="d-flex cursor-default">
														<h4>{{ $pizza->created_at->format('d M Y') }}</h4>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row mt-3">
								<a class="description-hover d-flex justify-content-between cursor-pointer" href="{{ route('products#edit', $pizza->id) }}?key=description">
									<div class="label text-decoration-underline fw-bold">Description :</div>
									<div class="icon text-right">
										<i class="fa-solid fa-pen-to-square"></i>
									</div>
								</a>
								<div class="text-muted pt-3" id="description" style="font-size:1.1rem">
									@php
										$description = nl2br(e($pizza->description));
										echo $description;
									@endphp
								</div>
							</div>
							<div class="row justify-content-end mt-4"><button class="btn btn-outline-dark" style="width: fit-content">Edit This Post</button></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<img class="w-100" src="{{ asset('storage/images/products/' . $pizza->image) }}">
		</div>
	</div>
@endsection
