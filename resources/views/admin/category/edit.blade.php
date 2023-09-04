@extends('admin.layouts.master')
@section('title')
	Edit | {{ $category->name }}
@endsection

@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="row">
					<div class="col-3 offset-7">
						<a href="{{ route('category#list') }}"><button class="btn btn-outline-dark my-3">Category List</button></a>
					</div>
				</div>
				<div class="col-lg-6 offset-3">
					<div class="card">
						<div class="card-body">
							<div class="card-title">
								<h4 class="title-2 text-center">Edit
									<span class="category rounded">{{ $category->name }}</span>
									<div class="d-inline-block mt-2">Category</div>
								</h4>
							</div>
							<hr>
							<form action="{{ route('category#update') }}" method="post">
								@csrf
								<div class="form-group my-3">
									<label class="control-label mb-1" for="name">Name <span class="text-danger">*</span></label>
									<input id="name" name="id" type="hidden" value="{{ $category->id }}">
									<input class="form-control @error('categoryName') is-invalid @enderror" id="cc-pament" name="categoryName" type="text" value='{{ old('categoryName', $category->name) }}' autofocus placeholder="Seafood...">
									@error('categoryName')
										<div class="invalid-feedback"> {{ $message }} </div>
									@enderror
								</div>

								<div>
									<button class="btn btn-info float-end" type="submit">
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
