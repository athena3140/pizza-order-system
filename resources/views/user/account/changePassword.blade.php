@extends('user.layouts.master')
@section('title', 'Change Password')
@section('content')
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-5">
				<div class="card card-outline-secondary rounded">
					<div class="card-header">
						<h3 class="mb-0 py-2">Change Password</h3>
					</div>
					<div class="card-body">
						@if (session('passChangeSuccess'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								Your <strong>password</strong> was successfully changed.
								<button class="close" data-dismiss="alert" type="button" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif
						<form class="form" role="form" action="{{ route('user#updatePassword') }}" method="POST" autocomplete="off">
							@csrf

							@if (session('status'))
								<div class="alert alert-danger">
									{{ session('status') }}
								</div>
							@endif

							<div>
								<label for="inputPasswordOld">Current Password <span class="text-danger">*</span></label>
								<input class="form-control @error('oldPassword') is-invalid @enderror @if (session('status')) is-invalid @endif" id="inputPasswordOld" name="oldPassword" type="password">
								@error('oldPassword')
									<div class="invalid-feedback"> {{ $message }} </div>
								@enderror
							</div>
							<div class="my-4">
								<label for="inputPasswordNew">New Password <span class="text-danger">*</span></label>
								<input class="form-control @error('newPassword') is-invalid @enderror" id="inputPasswordNew" name="newPassword" type="password">
								@error('newPassword')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div>
								<label class="d-flex justify-content-between" for="inputPasswordNewVerify">
									<div class="left">Confirm New Password <span class="text-danger">*</span></div>
								</label>
								<input class="form-control @error('confirmPassword') is-invalid @enderror" id="inputPasswordNewVerify" name="confirmPassword" type="password">
								@error('confirmPassword')
									<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
							<div class="form-group">
								<button class="btn btn-outline-success float-right mt-3 rounded" type="submit">Change</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
