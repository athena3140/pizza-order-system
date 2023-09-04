@extends('layouts.master')
@section('title', 'Login')
@section('height', '100vh')

@section('content')
	<div class="login-form">
		@error('email')
			<div class="alert alert-danger">{{ $message }}</div>
		@enderror
		<form action="{{ route('login') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="email">Email Address <span class="text-danger">*</span></label>
				<input class="au-input au-input--full" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Email">
			</div>
			<div class="form-group my-4">
				<label for="password">Password <span class="text-danger">*</span></label>
				<input class="au-input au-input--full" id="password" name="password" type="password" placeholder="Password">
				@error('password')
					<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>

			<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

		</form>
		<div class="register-link">
			<p>
				Don't you have account?
				<a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
			</p>
		</div>
	</div>
@endsection
