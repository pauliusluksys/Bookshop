<x-app-layout>
	here you can see your added to a list books


	@if ($message = Session::get('success'))
	<div class="alert alert-success"  role="alert">
		<p>{{ $message }}</p>
	</div>
	@endif
	<div class="container">
		<div class="row">
			<div class="col-2">
				One of three columns
			</div>
			<div class="col-7">
				<table class="table table-primary table-striped">
					<thead>
						<tr>
							<th scope="col">Nr</th>
							<th scope="col">Title</th>
							<th scope="col">Author</th>
							<th scope="col">Confirmed</th>
							<th scope="col">Full Information</th>
						</tr>
					</thead>
					<tbody>
						@php
						$i = 1;
						@endphp
						@foreach($books as $book)

						<tr>
							<th scope="row">{{$i++}}</th>
							<td>{{$book->title}}</td>
							<td>
								@foreach($book->author as $author)
								{{$author->name}}
								@endforeach
							</td>
							<td>{{$book->isConfirmeds->isConfirmedType->name}}</td>
							<td><a href="{{url('user/books/' . $book->id)}}">-></a></td>
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>
			<div class="col-3">
				<a href="{{route('user.books.create')}}">Add a new book to the list</a>
			</div>
		</div>
	</div>
	







</x-app-layout>