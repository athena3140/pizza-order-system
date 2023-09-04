@extends('user.layouts.master')
@section('title', 'Contact')
@section('content')
	<div class="container">
		<h3 class="mb-4 pb-2 text-center">Contact Us</h3>
		<div class="row d-flex justify-content-center">
			<div class="col-4">
				<img class="w-100" src="{{ asset('storage/images/contact.png') }}" />
			</div>
			<div class="col-5">
				<div class="alert alert-success" style="display: none">
					Thank you for your submission! We will be in touch soon.
				</div>
				<form id="contact" action="{{ route('ajax#contact') }}">
					<div class="form-floating">
						<input class="form-control rounded" id="name" name="name" type="text" placeholder="Name" />
						<label for="name">Name</label>
					</div>
					<div class="form-floating my-3">
						<input class="form-control rounded" id="email" name="email" type="email" placeholder="Email" />
						<label for="email">Email</label>
					</div>
					<div class="form-floating">
						<textarea class="form-control rounded" id="message" name="message" style="min-height: 170px" placeholder="Message"></textarea>
						<label for="message">Message</label>
					</div>
					<button class="btn-warning btn disabled my-3 rounded">Send </button>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function() {
			$("form .btn").removeClass('disabled')
			$("form#contact").submit(function(event) {
				event.preventDefault();
				$(".text-danger").remove();
				validateField("#name", "Please enter your name");
				validateEmail("#email");
				validateField("#message", "Please enter a message More than 5 characters.", 5);
				if ($(".text-danger").length === 0) {
					submitFormAjax();
					$("form .btn").addClass('disabled')
				}
			});

			function submitFormAjax() {
				event.preventDefault();
				var formData = $("form#contact").serialize();
				$(".text-danger").remove();
				$.ajax({
					url: $("form#contact").attr("action"),
					type: "POST",
					data: formData,
					headers: {
						"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
					},
					success: function(response) {
						$("div.alert.alert-success").slideDown();
						setTimeout(() => {
							$("div.alert.alert-success").slideUp();
						}, 7000);
						$("form#contact :input, textarea").val('');
						$("form .btn").removeClass('disabled')
					},
					error: function(xhr) {
						$(".text-danger").remove();
						if (xhr.status === 422) {
							var errors = xhr.responseJSON.errors;
							$.each(errors, function(field, error) {
								$("#" + field).after('<small class="text-danger">' + error[0] + '</small>');
							});
						}
					}
				});
			}

			function validateField(fieldSelector, errorMessage, minLength = 0) {
				var fieldValue = $(fieldSelector).val();
				if (fieldValue === "" || (minLength > 0 && fieldValue.length < minLength)) {
					$(fieldSelector).after('<small class="text-danger">' + errorMessage + '</small>');
				}
			}

			function validateEmail(emailSelector) {
				var email = $(emailSelector).val();
				if (email === "") {
					$(emailSelector).after('<small class="text-danger">Please enter your email</small>');
				} else if (!isValidEmail(email)) {
					$(emailSelector).after('<small class="text-danger">Please enter a valid email</small>');
				}
			}

			function isValidEmail(email) {
				var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
				return emailRegex.test(email);
			}

		});
	</script>
@endsection
