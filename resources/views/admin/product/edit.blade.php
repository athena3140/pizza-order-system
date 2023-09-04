@extends('admin.layouts.master')
@section('title')
	{{ 'Edit | ' . $pizza->name }}
@endsection

@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid d-flex justify-content-center align-items-center flex-column">
				<div class="col-lg-12">
					<div class="col-md-12">
						<div class="card card-outline-secondary rounded">
							<div class="border-bottom d-flex justify-content-center align-items-center mb-0 px-4 pt-4 pb-3">
								<button class="backBtn" onclick="javascript:history.back()"><i class="fa-solid fa-arrow-left fs-4"></i></button>
								<h3 class="mx-auto">
									Edit
									<span class="category mx-2 rounded">{{ $pizza->name }}</span>
									<div class="d-inline-block mt-2">Product</div>
								</h3>
							</div>
							<div class="card-body">
								<div class="container pt-2">
									<form action="{{ route('products#update', $pizza->id) }}" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="row">
											<div class="col-4 ms-md-5">
												<div class="ratio ratio-1x1">
													<img class="img-thumbnail object-fit-cover mx-auto shadow-sm" src="{{ asset('storage/images/products/' . $pizza->image) }}">
												</div>
												<div class="mt-5 rounded pt-4">
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
										<div class="col-7 d-flex flex-column justify-content-between order-first">
											<div class="form-group">
												<label class="small" for="name">Name <span class="text-danger">*</span></label>
												<input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name', $pizza->name) }}">
												@error('name')
													<small class="text-danger">{{ $message }}</small>
												@enderror
											</div>
											<div class="form-group">
												<label class="small" for="description">Description <span class="text-danger">*</span></label>
												<textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" cols="30" rows="4.5">{{ old('description', $pizza->description) }}</textarea>
												@error('description')
													<small class="text-danger">{{ $message }}</small>
												@enderror
											</div>
											<div class="form-group">
												<label class="small" for="category">Category <span class="text-danger">*</span></label>
												<select class="@error('category') is-invalid @enderror form-select" id="category" name="category">
													<option value="default">Choose category</option>
													@foreach ($category as $category)
														<option value="{{ $category->id }}" @if ($category->id == $pizza->category_id) selected @endif>{{ $category->name }}</option>
													@endforeach
												</select>
												@error('category')
													<small class="text-danger">{{ $message }}</small>
												@enderror
											</div>
											<div class="form-group row justify-content-between">
												<div class="col">
													<label class="control-label mb-1" for="price">Price <span class="text-danger">*</span></label>
													<div class="input-group">
														<label class="input-group-text border-right-0 fs-5 fw-bold" id="basic-addon1" for="price"><i class="fa-solid fa-dollar-sign"></i></label>
														<input class="form-control @error('price') is-invalid @enderror" id="price" name="price" type="number" value="{{ old('price', $pizza->price) }}" style="border-left: 0px;" pattern="[0-9]*" inputmode="numeric" placeholder="Enter Product's Price">
													</div>
													@error('price')
														<small class="invalid-feedback d-block">{{ $message }}</small>
													@enderror
												</div>
												<div class="col">
													<label class="control-label mb-1" for="waitingTime">Waiting Time <span class="text-danger">*</span></label>
													<div class="input-group">
														<label class="input-group-text border-right-0 fs-5 fw-bold" id="basic-addon1" for="waitingTime"><i class="fa-solid fa-clock"></i></label>
														<input class="form-control @error('waitingTime') is-invalid @enderror" id="waitingTime" name="waitingTime" type="number" value="{{ old('waitingTime', $pizza->waiting_time) }}" style="border-left: 0px;" list="times" placeholder="Waiting Time">
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
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-11 ms-md-5 d-flex justify-content-end"><button class="btn btn-outline-dark" type="submit">Edit</button></div>
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
