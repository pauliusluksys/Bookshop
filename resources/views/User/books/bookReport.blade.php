<x-app-layout>

	
	<div class="container">
		<div class="row">
			<div class="col-sm">
				
			</div>
			<div class="col-sm">
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<form action="{{route('user.BooksReport.send',$id)}}" method="POST">
					@csrf
					<input type="hidden" id="custId" name="report_book_id" value="{{$id}}">
					<div class="mb-3">
						<label for="book_report" class="form-label">Write Your Report</label>
						<textarea rows="6" id="book_report" class="form-control" name="report_book_message"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="col-sm">
			</div>



		</x-app-layout>