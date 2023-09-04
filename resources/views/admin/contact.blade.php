@extends('admin.layouts.master')
@section('title', 'Contacts')
@section('content')
	<div class="main-content">
		<div class="section__content section__content--p30">
			<div class="container-fluid">
				<div class="col-md-12 mb-5 pb-5">
					<!-- DATA TABLE -->
					<div class="row mb-3">
						<div class="col">
							<div class="table-data__tool mb-1">
								<div class="table-data__tool-left">
									<div class="overview-wrap">
										<h2 class="title-1">Contacts</h2>
									</div>
								</div>
							</div>
							<div class="d-flex">
								<div> <i class="far fa-folder-open me-2"></i>{{ $data->count() }} records found</div>
							</div>
						</div>
					</div>
					<div class="table-responsive table-responsive-data2">
						<table class="table-data2 table">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Message</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody id="tbody">
								@foreach ($data as $d)
									<tr class="tr-shadow">
										<td class="text-center">{{ $d->name }}</td>
										<td class="text-center">{{ $d->email }}</td>
										<td style="max-width: 350px;max-height: 100px">
											<div class="message-text">
												<div class="truncated-text">
													{{ Str::limit($d->message, 100, '...') }}
												</div>
												<div class="expanded-text" style="display: none;">
													{{ $d->message }}
												</div>
												@if (strlen($d->message) > 100)
													<a class="expand-button" href="#">Show more</a>
												@endif
											</div>
										</td>
										<td class="text-center">{{ $d->created_at->format('M d, Y') }}</td>
									</tr>
									<tr class="spacer"></tr>
								@endforeach
							</tbody>
						</table>
						<div class="mt-3">
							{{ $data->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		$(document).ready(function() {
			$(".expand-button").click(function(e) {
				e.preventDefault();
				var t = $(this).parent(),
					i = t.find(".truncated-text"),
					n = t.find(".expanded-text"),
					d = $(this);
				i.is(":visible") ? (i.slideUp(), n.slideDown(), d.text("Show less")) : (i.slideDown(), n.slideUp(), d.text("Show more"))
			})
		});
	</script>
@endsection
