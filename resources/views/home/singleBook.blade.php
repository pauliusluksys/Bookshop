<x-app-layout>
	

<div class="container">
	<div class="d-flex justify-content-between pt-4">
		    <div>
      		
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
     @livewire('book-ratings', ['book' => $book], key($book->id))
    <div class="col">
      
    </div>
  </div>
  </div>




</x-app-layout>