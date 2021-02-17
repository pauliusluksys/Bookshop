<x-app-layout>
  <x-slot name="header">
    
       <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <form method="GET" action="{{route('searchBar.index')}}">
        <div class="searchbar">
          
          <input class="search_input" type="text" name="search" placeholder="Search...">
          <button class="search_icon"><i class="fas fa-search"></i></button>
        </div>
      </form>
        </div>
      </div>
    
    
  </x-slot>

  <div class="container py-12">
    <div class="row">
      <div class="col-1">

      </div>
      <div class="col-10 d-inline">
        <div class="d-flex justify-content-center">
         <div class="box">
          @foreach($books as $book)
          <div class="p-1">
            <a href="{{url('books/' . $book->id)}}">

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

                <div class="h-25 d-inline-block text-truncate" style="width:100px;">
                  @foreach($book->author as $author)
                  {{$author->name}}
                  @endforeach
                </div>

              </div>
              <div class="d-inline-block text-truncate">
                @if($book->discount===null)
                {{$book->price}}€
                @else
                €{{round($book->price-$book->price*($book->discount/100),2)}} 
                <p class="text-muted text-sm m-0 d-inline"><del>€{{$book->price}}</del></p>
                @endif
              </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
      <div class="d-flex justify-content-center">
        {{ $books->links() }}
      </div>
    </div>


    <div class="col-1">

    </div>
  </div>
</div>
</div>



</x-app-layout>
