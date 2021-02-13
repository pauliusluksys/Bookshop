<x-app-layout>
	 @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
@if ($message = Session::get('success'))
<div class="alert alert-success"  role="alert">
<p>{{ $message }}</p>
</div>
@endif
<div class="container-float mx-4">
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
      	
     </div>
  <div class="row  py-12">
    <div class="col-3 d-flex">
      <div class="single-book-image border">
       <img src="{{$book->id}}" alt="" title=""/>
        <div>

          <form action="{{url('/admin/books/'.$book->isConfirmeds->id.'/status')}}" method="POST">
            @csrf
            
            <p><strong>Status:</strong></p>
            <select class="form-select" aria-label="Default select example" name="book_is_confirmed_type">
              <option selected>Open this select menu</option>
              <option value="1">Not Confirmed</option>
              <option value="2">Confirmed</option>
              <option value="3">Denied</option>
            </select>
           <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <p><strong>Submitted:</strong> {{$book->created_at->diffForHumans()}}</p>
          
          <p><strong>Submitted By:</strong></p>
          <p>Name:{{$book->user->name}}</p>
          <p>Email:{{$book->user->email}}</p>
          <p><button type="button" class="btn btn-primary">Send a message</button></p>
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
      </div>
    
    <div class="col-6 d-flex">

      
        
      <div class="mx-4"> 
      	<div>
      	  <h2><strong>Title:</strong> {{$book->title}}</h2> 
      	  <h6 class="text-muted"><strong>Author:</strong> {{$book->author_id}}</h6>
      	</div>
      	<div class="py-6">
      	  <p><strong>Description:</strong> {{$book->description}}</p>
      	</div>
        
      </div>
    </div>
    <div class="col-3 d-flex">
    </div>
  </div>
  </div>




</x-app-layout>