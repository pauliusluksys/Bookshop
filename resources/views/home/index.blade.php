<x-app-layout>
  <x-slot name="header">




  </x-slot>

  <div class="container py-12">
    <div class="row">
      <div class="col-1">

      </div>
      <div class="col-10 d-inline">
          @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>

          @elseif(session('error'))
                  <div class="alert alert-error">
                      {{ session('error') }}
                  </div>
          @endif
        <div class="d-flex justify-content-center">
         <div class="box">
          @foreach($books as $book)
          <div class="p-1">
            <a href="{{url('books/' . $book->id)}}">

             <div class="border border-primary book-picture-container position-relative">
              <img src="{{asset($book->getMedia('books_images')->first()->getUrl())}}" class="img-responsive fit-image"/>
              @if(Carbon\Carbon::now()->subDays(7)->toDateTimeString()<$book->created_at)

              <div class="book-new bg-success text-white">new</div>
              @endif
              @if($book->discount!==NULL&&$book->discount>0)
              <div class="book-discount bg-primary text-white">{{$book->discount."%"}}</div>
              @endif
            </div>

            <div class="border border-primary book-information-container">
              <div class="h-25 d-inline-block text-truncate">{{$book->title}}</div>
              <div>

                <div class="h-25 d-inline-block text-truncate" style="width:100px;">
                  @foreach($book->authors as $author)
                  {{$author->name}}
                  @endforeach
                </div>

              </div>
              <div class="d-inline-block text-truncate">
                @if($book->discount!==NULL&&$book->discount>0)
                      €{{round($book->price-$book->price*($book->discount/100),2)}}
                      <p class="text-muted text-sm m-0 d-inline"><del>€{{$book->price}}</del></p>
                @else
                      {{$book->price}}€

                @endif
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
    <div class="d-flex justify-content-center">
      @if($books!==[]){{ $books->links() }}@endif
    </div>
  </div>


  <div class="col-1">

  </div>
</div>
</div>
</div>



</x-app-layout>
