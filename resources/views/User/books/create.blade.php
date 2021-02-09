<x-app-layout>
	here you can add a new book
<div class="container">
  <div class="row">
    <div class="col-sm">
      One of three columns
    </div>
    <div class="col-sm">
    @if ($errors->any())
    	<div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
      <form method="POST" action="{{route('user.books.store')}}">
      	@csrf
		  <div class="mb-3">
		    <label for="book_title" class="form-label">Your book title:</label>
		    <input type="text" class="form-control" id="book_title" name="book_title">
		    
		  </div>
		  <div class="mb-3">
		    <label for="book_author" class="form-label">Book author:</label>
		    <input type="text" class="form-control" id="book_author" aria-describedby="author_help" name="book_author">
		    <div id="author_help" class="form-text">If there are more than one author, separate them by comma</div>
		  </div>
		  
		  <div class="mb-3">
		    <label for="book_description" class="form-label">Write some decsription about the book:</label>
		    <textarea class="form-control" id="book_description" rows="4" name="book_description"></textarea>
		  </div>

		  <button type="submit" class="btn btn-primary">Submit</button>
	  </form>
    </div>
    <div class="col-sm">
      One of three columns
    </div>
  </div>
</div>
	


</x-app-layout>