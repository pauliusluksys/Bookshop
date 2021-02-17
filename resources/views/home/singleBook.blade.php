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
            @if($book->discount===null)
            {{$book->price}}€
            @else
            €{{$book->price-$book->price*($book->discount/100)}} <div class="d-inline-block position-relative">
              <div class="position-absolute" style="bottom:1px; white-space: nowrap;"><p class="text-muted text-sm m-0 d-inline"><del>€{{$book->price}}</del></p><p class=" text-sm m-0 d-inline" style="white-space: nowrap;"> {{$book->discount}}% off</p></div></div>
            @endif
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
        <div><a href="/user/books/{{$book->id}}/report">Report this book</a></div>
      </div>
    </div>
      @livewire('book-ratings', ['book' => $book], key($book->id))
    </div>
     
    <div class="col-2">
      
    </div>
  </div>
  </div>




</x-app-layout>