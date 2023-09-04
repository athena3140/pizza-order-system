@extends('admin.layouts.master')
@section('title', 'Create Product')

@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-8 text-end">
						<a href="{{ route('products#list') }}"><button class="btn bg-dark my-3 text-white">Products List</button></a>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-8">
						<div class="card rounded">
							<div class="card-body">
								<div class="card-title">
									<h3 class="title-2 mn-3 text-center">Create New Pizza</h3>
								</div>
								<hr>
								<form class="mt-4" action="{{ route('products#store') }}" method="post" enctype="multipart/form-data">
									@csrf
									<div class="form-group row justify-content-between my-3">
										<div class="col-7">
											<label class="control-label mb-1" for="name">Name <span class="text-danger">*</span></label>
											<input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name') }}" autofocus placeholder="Enter Product Name">
											@error('name')
												<small class="invalid-feedback">{{ $message }}</small>
											@enderror
										</div>
										<div class="col-5">
											<label class="control-label mb-1" for="img">Image <span class="text-danger">*</span></label>
											<input class="form-control-file @error('img') is-invalid @enderror form-control fs-6" id="img" name="img" type="file">
											@error('img')
												<small class="invalid-feedback">{{ $message }}</small>
											@enderror
										</div>
									</div>
									<div class="form-group my-3">
										<label class="control-label mb-1" for="category">Category <span class="text-danger">*</span></label>
										<select class="form-control @error('category') is-invalid @enderror form-select" id="category" name="category">
											<option value="default" selected>Choose Your Category Here.....</option>
											@foreach ($categories as $category)
												<option value="{{ $category->id }}">{{ $category->name }}</option>
											@endforeach
										</select>
										@error('category')
											<small class="invalid-feedback">{{ $message }}</small>
										@enderror
									</div>
									<div class="form-group my-3">
										<label class="control-label mb-1" for="description">Description <span class="text-danger">*</span></label>
										<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" cols="30" rows="4" placeholder="Enter Product's Description">{{ old('description') }}</textarea>
										@error('description')
											<small class="invalid-feedback">{{ $message }}</small>
										@enderror
									</div>
									<div class="form-group row justify-content-between my-3">
										<div class="col-7">
											<label class="control-label mb-1" for="price">Price <span class="text-danger">*</span></label>
											<div class="input-group">
												<label class="input-group-text border-right-0 fs-5 fw-bold" id="basic-addon1" for="price"><i class="fa-solid fa-dollar-sign"></i></label>
												<input class="form-control @error('price') is-invalid @enderror" id="price" name="price" type="number" value="{{ old('price') }}" style="border-left: 0px;" pattern="[0-9]*" inputmode="numeric" placeholder="Enter Product's Price">
											</div>
											@error('price')
												<small class="invalid-feedback d-block">{{ $message }}</small>
											@enderror
										</div>
										<div class="col-5">
											<label class="control-label mb-1" for="waitingTime">Waiting Time <span class="text-danger">*</span></label>
											<div class="input-group">
												<label class="input-group-text border-right-0 fs-5 fw-bold" id="basic-addon1" for="time"><i class="fa-solid fa-clock"></i></label>
												<input class="form-control @error('waitingTime') is-invalid @enderror" id="time" name="waitingTime" type="number" value="{{ old('waitingTime') }}" style="border-left: 0px;" list="times" placeholder="Enter waiting time">
												<datalist id="times">
													<option value="5">
													<option value="10">
													<option value="15">
													<option value="20">
													<option value="25">
													<option value="30">
													<option value="35">
													<option value="40">
													<option value="45">
													<option value="50">
													<option value="55">
													<option value="60">
												</datalist>
											</div>
											@error('waitingTime')
												<small class="invalid-feedback d-block">{{ $message }}</small>
											@enderror
										</div>
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
	</div>
@endsection
