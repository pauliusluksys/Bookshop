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

         @else
         <img src="{{asset('storage/IMG_20210206_152320.jpg')}}" class="img-responsive fit-image"/>
         @endif
       </div>
       <div class="mx-12">
         <div>
           <h2><strong>Title: </strong> {{$book->title}}</h2>
           <h6 class="text-muted"><strong>Author(s):</strong>
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
            @if($book->discount!==NULL&&$book->discount>0)
                  €{{round($book->price-$book->price*($book->discount/100),2)}} <div class="d-inline-block position-relative">
                      <div class="position-absolute" style="bottom:1px; white-space: nowrap;"><p class="text-muted text-sm m-0 d-inline"><del>€{{$book->price}}</del></p><p class=" text-sm m-0 d-inline" style="white-space: nowrap;"> {{$book->discount}}% off</p></div></div>
            @else
                  {{$book->price}}€

              @endif
            </div>
            <div><strong>Discount:</strong>
              @if($book->discount!==NULL&&$book->discount>0)
                    {{$book->discount}}%

              @else
                    No discount
              @endif
            </div>
          </div>
          <div class="d-inline-flex align-items-center" >
            <div class="d-inline-block"><h4>⭐</h4></div>
            <div class="d-inline-block">
             @if($book->ratings->count())
             <div class="text-right"><strong>

              {{round($book->ratings->avg('rating'),1)}}/5</strong></div>
              <div class="text-sm text-right">{{$book->ratings->count()}}</div>
              @else
              <div class="text-right"><strong>Not Rated</strong></div>



              @endif
            </div>
          </div>
          <div class="py-6">
           <p><strong>Description:</strong> {{$book->description}}</p>
         </div>
         @auth<div><form action="{{route('user.BooksReport.send',$book->id)}}" method="POST">
                @csrf
                <button type="submit">Report this book</button>
               </form>
           </div>@endauth
       </div>
     </div>

   </div>

   <div class="col-2">

   </div>
 </div>
        <div class="row  py-12">
            <div class="col-2">

            </div>
            <div class="col-8">

                <livewire:ratings :book="$book"/>
            </div>
            <div class="col-2">

            </div>
        </div>
</div>

    </x-app-layout>



