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
				<form method="POST" action="{{url('user/books/'.$book->id)}} " enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="mb-3">
						<label for="book_title" class="form-label">Your book title:</label>
						<input type="text" class="form-control" id="book_title" name="book_title" value="{{$book->title}}">

					</div>
					<div class="mb-3">
						<label for="book_author" class="form-label">Book author:</label>
						<input type="text" class="form-control" id="book_author" aria-describedby="author_help" name="book_author" value="@foreach($book->authors as $author)@if($loop->first){{$author->name}}@else,{{$author->name}}@endif{{""}}@endforeach">
						<div id="author_help" class="form-text">If there are more than one author, separate them by comma</div>
					</div>

					@foreach($genres as $genre)
					<div class="mb-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="{{$genre->name}}" name="genres[]"id="" @foreach($book->genres as $bookGenre)
							@if($bookGenre->name==$genre->name) checked="true"
							@endif
							@endforeach>
							<label class="form-check-label" for="defaultCheck1">{{$genre->name}}
							</label>
						</div>
					</div>
					@endforeach

					<div class="mb-3">

						<div class="input-group">
							<label for="book_price" class="form-label">Suggested Price:</label>


							<input type="text" class="form-control text-right" id="book_price" aria-describedby="author_help" name="book_price" value="{{$book->price}}">
							<div class="input-group-pretend ">
								<div class="input-group-text">€</div>
							</div>
						</div>
					</div>

					<div class="mb-3">
						<label for="book_description" class="form-label">Write some decsription about the book:</label>
						<textarea class="form-control" id="book_description" rows="4" name="book_description">{{$book->description}}</textarea>
					</div>
                    <div class="mb-3">
                        <label for="book_image" class="form-label">Book image:</label>
                        <input type="file" class="form-control" id="book_image" name="book_image">
                    </div>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
			<div class="col-sm">

			</div>
		</div>
	</div>



</x-app-layout>
