<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hello Regular user!
        </h2>
    </x-slot>
    
  <div class="container py-12">
  <div class="row">
    <div class="col-1">
      One of three columns
    </div>
    <div class="col-10 d-flex justify-content-center">

     <div class="box">
     	@foreach($books as $book)
        <a href="{{url('books/' . $book->id)}}"><div class="p-1">

        	<div class="border border-primary book-picture-container position-relative">
        		
  				@if(Carbon\Carbon::now()->subDays(7)->toDateTimeString()<$book->created_at)
				
        		<div class="book-new bg-success text-white">new</div>
        		@endif
        		@if($book->discount!==NULL)
        		<div class="book-discount bg-primary text-white">{{$book->discount."%"}}</div>
        		@endif
        	</div>
        	
        	<div class="border border-primary book-information-container">	 
        		<div class="h-25 d-inline-block text-truncate">{{$book->title}}</div>
        		<div>
        			@foreach($book->author as $author)
    				<div class="h-25 d-inline-block text-truncate" style="width:100px;">{{$author->name}}</div>
    				@endforeach
    			</div>
        		<div class="" >Price</div>
        	</div>
        </div></a>
        			@endforeach
      </div>

    </div>
    {{ $books->links() }}
    <div class="col-1">
      One of three columns
    </div>
  </div>
</div>
     

  
</x-app-layout>
