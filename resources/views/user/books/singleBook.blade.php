<x-app-layout>
	
	@if ($message = Session::get('success'))
	<div class="alert alert-success"  role="alert">
		<p>{{ $message }}</p>
	</div>
	@endif
	<div class="container">
		<div class="d-flex justify-content-between pt-4">
			<div>
				<h4 class="d-inline">Book Status:</h4> 
				@if($book->confirmation->type=='Waiting')
				<h4 class="text-warning d-inline">{{$book->confirmation->type}}
				</h4>
				@elseif($book->confirmation->type=='Accepted')
				<h4 class="text-success d-inline">{{$book->confirmation->type}}</h4>

				@else
				<h4 class="text-danger d-inline">{{$book->confirmation->type}}
				</h4>
				@endif
			</div>
			<div>
				Actions:
				
				<a class="btn btn-primary" href="{{url('user/books/'.$book->id.'/edit')}}" role="button">Edit</a>
				<form method="POST" action="{{url('user/books/'.$book->id)}}" class="d-inline">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>
			</div>
		</div>
		<div class="row  py-12">
			<div class="col">
				
			</div>
			<div class="col-8 d-flex">
				<div class="single-book-image border">
					@if($book->getMedia('books_images')->first())
					<img src="{{asset($book->getMedia('books_images')->first()->getUrl())}}" alt="Italian Trulli">
					@endif
				</div>
				<div class="mx-12"> 
					<div>
						<h6 class="text-muted"><strong>Last updated at:</strong> 
							{{$book->updated_at}} 
						</h6>
						<h2><strong>Title: </strong> {{$book->title}}</h2> 
						<h6 class="text-muted"><strong>Author:</strong> 
							@foreach($book->authors as $author)
							@if ($loop->first) {{$author->name}} 
							@else
							,{{$author->name}}
							@endif
							@endforeach
						</h6>

						<h6 class="text-muted"><strong>Genre:</strong> 
							@foreach($book->genres as $genre)
							@if ($loop->first) {{$genre->name}} 
							@else
							,{{$genre->name}}
							@endif
							@endforeach
						</h6>
						<div><strong>Price:</strong>
							
							
							
							@if($book->discount===null)
							{{$book->price}}€
							@else
							€{{round($book->price-$book->price*($book->discount/100),2)}} <div class="d-inline-block position-relative">
								<div class="position-absolute" style="bottom:1px; white-space: nowrap;"><p class="text-muted text-sm m-0 d-inline"><del>€{{$book->price}}</del></p><p class=" text-sm m-0 d-inline" style="white-space: nowrap;"> {{$book->discount}}% off</p></div></div>
								@endif
							</div>
						</div>
						<div class="py-6">
							<p><strong>Description:</strong> {{$book->description}}</p>
						</div>
					</div>
				</div>
				<div class="col">
					
				</div>
			</div>
		</div>




	</x-app-layout>