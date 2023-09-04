@extends('admin.layouts.master')
@section('title', 'Category')
@section('form')
	<form method="GET" action="{{ route('category#list') }}">
		<div class="input-group">
			<label class="input-group-text" for="search"><i class="fa fa-search"></i></label>
			<input class="form-control input" id="search" name="search" type="search" value="{{ request('search') }}" placeholder="Search something....." required>
			<button class="btn btn-outline-secondary" type="submit">Search</button>
		</div>
	</form>
@endsection

@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="col-md-12 mb-5 pb-5">
					<!-- DATA TABLE -->
					<div class="table-data__tool mb-1">
						<div class="table-data__tool-left">
							<div class="overview-wrap">
								<h2 class="title-1">Product Lists</h2>
							</div>
						</div>
						<div class="table-data__tool-right">
							<a href="{{ route('category#create') }}">
								<button class="au-btn au-btn-icon au-btn--green au-btn--small">
									<i class="zmdi zmdi-plus"></i>add item
								</button>
							</a>
							<button class="au-btn au-btn-icon au-btn--green au-btn--small">CSV download</button>
						</div>
					</div>
					<div class="d-flex mb-4">
						<div> <i class="far fa-folder-open me-2"></i> {{ $categories->count() }} records found</div>
					</div>
					@if ($categories->isEmpty())
						<h3 class="alert alert-warning text-secondary border-warning mt-5 rounded border p-5 text-center outline">
							@if (request('search'))
								Sorry, we couldn't find any categories for your search.
							@else
								There Is No Categories Has Been Created.
							@endif
						</h3>
					@else
						<div class="table-responsive table-responsive-data2">
							<table class="table-data2 table">
								<thead>
									<tr>
										<th class="text-left">Id</th>
										<th>Category Name</th>
										<th>Created Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($categories as $category)
										<tr class="tr-shadow">
											<td class="text-center">{{ $category->id }}</td>
											<td class="text-center"><span class="block-email text-center">{{ $category->name }}</span></td>
											<td class="text-center">{{ $category->created_at->format('M d, Y') }}</td>
											<td>
												<div class="table-data-feature">
													<a class="edit" href="{{ route('category#edit', $category->id) }}">
														<button class="item" data-tooltip="Edit">
															<i class="zmdi zmdi-edit"></i>
														</button>
													</a>
													<a class='delete delete-product' href="{{ route('category#delete', $category->id) }}">
														<button class="item" data-tooltip="Delete">
															<i class="zmdi zmdi-delete"></i>
														</button>
													</a>
												</div>
											</td>
										</tr>
										<tr class="spacer"></tr>
									@endforeach
									@if (session('message'))
										<script>
											toast('{{ session('message') }}', '{{ session('color') }}', '{{ session('backgroundColor') }}', '{{ session('borderColor') }}')
										</script>
									@endif

								</tbody>
							</table>
							<div class="mt-3">
								{{ $categories->appends(request()->query())->links() }}
							</div>
						</div>
					@endif
					<!-- END DATA TABLE -->
				</div>
			</div>
		</div>
	</div>
@endsection
