@extends('admin.layouts.master')
@section('title', 'Create Catrgory')

@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="row">
					<div class="col-3 offset-7">
						<a href="{{ route('category#list') }}"><button class="btn bg-dark my-3 text-white">Category List</button></a>
					</div>
				</div>
				<div class="col-lg-6 offset-3">
					<div class="card">
						<div class="card-body">
							<div class="card-title">
								<h3 class="title-2 text-center">Create New Category</h3>
							</div>
							<hr>
							<form action="{{ route('category#store') }}" method="post">
								@csrf
								<div class="form-group my-3">
									<label class="control-label mb-1" for="cc-payment">Name <span class="text-danger">*</span></label>
									<input class="form-control @error('categoryName') is-invalid @enderror" id="cc-pament" name="categoryName" type="text" value='{{ old('categoryName') }}' autofocus placeholder="Seafood...">
									@error('categoryName')
										<div class="invalid-feedback"> {{ $message }} </div>
									@enderror
								</div>

								<div>
									<button class="btn btn-info float-end" id="payment-button" type="submit">
										Create
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
