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
      		@if($book->isConfirmeds->is_confirmed_type_id===1)
      		  <h4 class="text-warning d-inline">{{$book->isConfirmeds->isConfirmedType->name}}
      		  </h4>
      		@elseif($book->isConfirmeds->is_confirmed_type_id===2)
      		  <h4 class="text-success d-inline">{{$book->isConfirmeds->isConfirmedType->name}}</h4>

      		  @else
      		  <h4 class="text-danger d-inline">{{$book->isConfirmeds->isConfirmedType->name}}
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
      1 of 3
    </div>
    <div class="col-8 d-flex">
      <div class="single-book-image border">
      	@if($book->getMedia('books_images')->first())
      	<img src="{{asset($book->getMedia('books_images')->first()->getUrl())}}" alt="Italian Trulli">
      	@endif
      </div>
      <div class="mx-12"> 
      	<div>
      	  <h2><strong>Title: </strong> {{$book->title}}</h2> 
      	  <h6 class="text-muted"><strong>Author:</strong> {{$book->author_id}}</h6>
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