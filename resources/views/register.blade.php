@extends('layouts.master')
@section('title', 'Register')

@section('content')
	<div class="login-form">
		<form class="d-flex flex-column gap-3" action="{{ route('register') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="name">Name <span class="text-danger">*</span></label>
				<input class="au-input au-input--full" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Name">
				@error('name')
					<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>
			<div class="form-group">
				<label for="email">Email Address <span class="text-danger">*</span></label>
				<input class="au-input au-input--full" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Email">
				@error('email')
					<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>
			<div class="form-group">
				<label for="gender">Gender <span class="text-danger">*</span></label>
				<select class="form-select" id="gender" name="gender">
					<option value="default" selected>Choose Gender</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>
				@error('gender')
					<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>
			<div class="d-flex justify-content-between">
				<div class="form-group">
					<label for="phone">Phone <span class="text-danger">*</span></label>
					<input class="au-input au-input--full" id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="Phone">
					@error('phone')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
				<div class="form-group">
					<label for="address">Address <span class="text-danger">*</span></label>
					<input class="au-input au-input--full" id="address" name="address" type="text" value="{{ old('address') }}" placeholder="Address">
					@error('address')
						<small class="text-danger">{{ $message }}</small>
					@enderror
				</div>
			</div>
			<div class="form-group">
				<label for="password">Password <span class="text-danger">*</span></label>
				<input class="au-input au-input--full" id="password" name="password" type="password" placeholder="Password">
				@error('password')
					<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>
			<div class="form-group">
				<label for="confirmPassword">Password <span class="text-danger">*</span></label>
				<input class="au-input au-input--full" id="confirmPassword" name="password_confirmation" type="password" placeholder="Confirm Password">
				@error('password')
					<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>

			<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

		</form>
		<div class="register-link">
			<p>
				Already have account?
				<a href="{{ route('auth#loginPage') }}">Sign In</a>
			</p>
		</div>
	</div>
@endsection
