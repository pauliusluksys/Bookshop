<x-app-layout>
	

<div class="container-fluid">
	<div class="d-flex justify-content-between pt-4">
		    <div>
      		
      	</div>
      	
     </div>
  <div class="row  py-12">
    <div class="col-2">
      
    </div>
    <div class="col-8 d-inline-block">
      <div class="d-flex">
      <div class="single-book-image border">
      	@if($book->getMedia('books_images')->first())
      	<img src="{{asset($book->getMedia('books_images')->first()->getUrl())}}" alt="Italian Trulli">
      	@endif
      </div>
      <div class="mx-12"> 
      	<div>
      	  <h2><strong>Title: </strong> {{$book->title}}</h2> 
      	  <h6 class="text-muted"><strong>Author(s):</strong>
            @foreach($book->author as $author)
           {{$author->name}} 
           @endforeach
          </h6>
          <h6 class="text-muted"><strong>Genre:</strong> 
            @foreach($book->genre as $genre)
            {{$genre->name}},
            @endforeach
          </h6>
          <div><strong>Price:</strong>
            {{$book->price}}€
          </div>
          <div><strong>Discount:</strong>
            @if($book->discount===null)
            No discount
            @else
            {{$book->discount}}%
            @endif
          </div>
      	</div>
        <div class="d-inline-flex align-items-center" >
          <div class="d-inline-block"><h4>⭐</h4></div>
          <div class="d-inline-block">
            <div class="text-right"><strong>4,5/5</strong></div>
            <div class="text-sm text-right">100 votes</div>
          </div>
        </div>
      	<div class="py-6">
      	  <p><strong>Description:</strong> {{$book->description}}</p>
      	</div>
      </div>
    </div>
      @livewire('book-ratings', ['book' => $book], key($book->id))
    </div>
     
    <div class="col-2">
      
    </div>
  </div>
  </div>




</x-app-layout>