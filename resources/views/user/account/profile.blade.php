@extends('user.layouts.master')
@section('title', 'Profile')
@section('content')
	@if (session('message'))
		<script>
			toast('{{ session('message') }}', '{{ session('color') }}', '{{ session('backgroundColor') }}', '{{ session('borderColor') }}')
		</script>
	@endif
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid d-flex justify-content-center align-items-center flex-column">
				<div class="col-lg-8">
					<div class="col-md-12">
						<div class="card card-outline-secondary rounded">
							<div class="card-header">
								<h3 class="mb-0 py-2 text-center">Profile</h3>
							</div>
							<div class="card-body">
								<div class="container">
									<div class="row">
										<div class="col-4 offset-1">
											<div class="ratio ratio-1x1">
												<img class="object-fit-cover w-100 h-100 img-thumbnail mx-auto cursor-pointer shadow-sm" id="profileImg" data-bs-toggle="modal" data-bs-target="#exampleModal" data-tooltip="Click To View The Image." src="@if (Auth::user()->image == null) {{ asset('storage/images/profiles/default.svg') }}@else{{ asset('storage/images/profiles/' . Auth::user()->image) }} @endif" style="border-radius: 50%;cursor:pointer">
											</div>
										</div>
										<div class="col-6 ps-5">
											<div class="user-info">
												<div class="label">Name :</div>
												<a class="value" href="{{ route('user#edit', ['key' => 'name']) }}">
													<span class="underLine">{{ Auth::user()->name }}</span>
													<div class="text-right">
														<i class="fa-solid fa-pen-to-square"></i>
													</div>
												</a>
												<div class="label">Email :</div>
												<a class="value" href="{{ route('user#edit', ['key' => 'email']) }}">
													<span class="underLine">{{ Auth::user()->email }}</span>
													<div class="text-right">
														<i class="fa-solid fa-pen-to-square"></i>
													</div>
												</a>
												<div class="label">Gender :</div>
												<a class="value" href="{{ route('user#edit', ['key' => 'gender']) }}">
													<span class="underLine">{{ Auth::user()->gender }}</span>
													<div class="text-right">
														<i class="fa-solid fa-pen-to-square"></i>
													</div>
												</a>
												<div class="label">Phone :</div>
												<a class="value" href="{{ route('user#edit', ['key' => 'phone']) }}">
													<span class="underLine">{{ Auth::user()->phone }}</span>
													<div class="text-right">
														<i class="fa-solid fa-pen-to-square"></i>
													</div>
												</a>
												<div class="label">Address :</div>
												<a class="value" href="{{ route('user#edit', ['key' => 'address']) }}">
													<span class="underLine">{{ Auth::user()->address }}</span>
													<div class="text-right">
														<i class="fa-solid fa-pen-to-square"></i>
													</div>
												</a>
												<div class="label">Role :</div>
												<div class="value cursor-default">
													<span class="underLine">{{ Auth::user()->role }}</span>
												</div>
											</div>
											<div class="row justify-content-end mt-4">
												<div class="col-lg-6">
													<a class="btn btn-outline-dark" href="{{ route('user#edit') }}">
														Edit Profile
														<i class="fa-solid fa-user-pen ms-2"></i>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
		<div class="modal-dialog modal-lg d-flex justify-content-center align-items-center">
			<img class="w-75" src="@if (Auth::user()->image == null) {{ asset('storage/images/profiles/default.svg') }}@else{{ asset('storage/images/profiles/' . Auth::user()->image) }} @endif">
		</div>
	</div>
@endsection
