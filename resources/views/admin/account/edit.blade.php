@extends('admin.layouts.master')
@section('title', 'Edit Profile')

@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid d-flex justify-content-center align-items-center flex-column">
				<div class="col-lg-12">
					<div class="col-md-12">
						<div class="card card-outline-secondary rounded">
							<h3 class="border-bottom mb-0 pt-4 pb-3 text-center">Edit Profile</h3>
							<div class="card-body">
								<div class="container pt-2">
									<form action="{{ route('admin#update') }}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="row">
											<div class="col-4 @if ($errors->any()) pb-5 mb-5 @enderror">
												<div class="ratio ratio-1x1">
                                                    <img class="img-thumbnail mx-auto shadow-sm" src="
                                                    @if (Auth::user()->image == null) {{ asset('storage/images/profiles/default.svg') }}
                                                    @else{{ asset('storage/images/profiles/' . Auth::user()->image) }} @endif" style="border-radius: 50%;object-fit: cover">
											</div>
											<div class="mt-5 rounded">
												<input class="form-control @error('img') is-invalid @enderror" name="img" type="file">
												@error('img')
													<small class="text-danger">{{ $message }}</small>
												@enderror
											</div>


										@section('script')
											<script>
												const fileInput = document.querySelector('input[name="img"]');
												const img = document.querySelector('.img-thumbnail');

												fileInput.addEventListener('change', (event) => {
													const file = event.target.files[0];
													const imgUrl = URL.createObjectURL(file);
													img.setAttribute('src', imgUrl);
												});
											</script>
										@endsection
									</div>
									<div class="col-7 ps-5 pe-0 d-flex flex-column justify-content-between">
										<div class="form-group">
											<label class="small" for="name">Name :</label>
											<input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}">
											@error('name')
												<small class="text-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="form-group">
											<label class="small" for="email">Email :</label>
											<input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="text" value="{{ old('email', Auth::user()->email) }}">
											@error('email')
												<small class="text-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="form-group">
											<label class="small" for="phone">Phone :</label>
											<input class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" type="text" value="{{ old('phone', Auth::user()->phone) }}">
											@error('phone')
												<small class="text-danger">{{ $message }}</small>
											@enderror
										</div>
										<div class="row">
											<div class="form-group col">
												<label class="small" for="gender">Gender :</label>
												<select class="@error('gender') is-invalid @enderror form-select" id="gender" name="gender">
													<option value="default">Choose Gender</option>
													<option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
													<option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
												</select>
												@error('gender')
													<small class="text-danger">{{ $message }}</small>
												@enderror
											</div>
											<div class="form-group col">
												<label class="small" for="address">Address :</label>
												<input class="form-control @error('address') is-invalid @enderror" id="address" name="address" type="text" value="{{ old('address', Auth::user()->address) }}">
												@error('address')
													<small class="text-danger">{{ $message }}</small>
												@enderror
											</div>
										</div>
										<div class="form-group">
											<label class="small" name="role" for="role">Role :</label>
											<select class="disabled form-select" id="role" name="role" disabled>
												<option value="admin" selected>admin</option>
											</select>
										</div>
									</div>
							</div>
							<div class="row mt-3">
								<div class="col-11 d-flex justify-content-end pe-0"><button class="btn btn-outline-dark" type="submit">Edit</button></div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
